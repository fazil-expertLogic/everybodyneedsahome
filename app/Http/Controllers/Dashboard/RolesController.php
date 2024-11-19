<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Role;
use App\Models\Menu;
use App\Models\Permission;
use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allow_show = Helper::check_rights(6)->is_show;
        $allow_create = Helper::check_rights(6)->is_create;
        $allow_edit = Helper::check_rights(6)->is_edit;
        $allow_delete = Helper::check_rights(6)->is_delete;

        $query = Role::active();
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%');
            });
        }
        $roles = $query->paginate(10);
        return view('livewire.role.index', compact('roles','allow_show','allow_create','allow_edit','allow_delete'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::active()->get();
        $menus = Menu::active()->get();
        return view('livewire.role.add',compact('menus','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'permissions' => 'array',
                'permissions.*.is_listing' => 'nullable|boolean',
                'permissions.*.is_show' => 'nullable|boolean',
                'permissions.*.is_create' => 'nullable|boolean',
                'permissions.*.is_edit' => 'nullable|boolean',
                'permissions.*.is_delete' => 'nullable|boolean',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $role = Role::create([
                'name' =>  $request->name,
            ]);
            // -------------------- permissions --------------------------
            $permissions = $request->input('permissions', []);

            foreach ($permissions as $menuId => $permissionData) {

                $permissionData = array_merge([
                    'is_listing' => 0,
                    'is_show' => 0,
                    'is_create' => 0,
                    'is_edit' => 0,
                    'is_delete' => 0,
                ], $permissionData);

                Permission::updateOrCreate(
                    [
                        'role_id' => $role->id,
                        'menu_id' => $menuId,
                    ],
                    [
                        'is_listing' => $permissionData['is_listing'],
                        'is_show' => $permissionData['is_show'],
                        'is_create' => $permissionData['is_create'],
                        'is_edit' => $permissionData['is_edit'],
                        'is_delete' => $permissionData['is_delete'],
                    ]
                );
            }
            // -------------------- permissions --------------------------
            DB::commit();
            return redirect()->route('roles.index')->with('success', 'Providers create successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the property. Please try again.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::where('role_id',$id)->get();
        $menus = Menu::active()->get();
        return view('livewire.role.show', compact('role','menus','permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::where('role_id',$id)->get();
        $menus = Menu::active()->get();
        return view('livewire.role.edit', compact('role','menus','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'permissions' => 'array',
                'permissions.*.is_listing' => 'nullable|boolean',
                'permissions.*.is_show' => 'nullable|boolean',
                'permissions.*.is_create' => 'nullable|boolean',
                'permissions.*.is_edit' => 'nullable|boolean',
                'permissions.*.is_delete' => 'nullable|boolean',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $role = Role::findOrFail($id);
            $role->update([
                'name' =>  $request->name,
            ]);
            // -------------------- permissions --------------------------
            $permissions = $request->input('permissions', []);
            
            Permission::where('role_id', $role->id)->update([
                'is_listing' => 0,
                'is_show' => 0,
                'is_create' => 0,
                'is_edit' => 0,
                'is_delete' => 0
            ]);
            
            foreach ($permissions as $menuId => $permissionData) {

                $permissionData = array_merge([
                    'is_listing' => 0,
                    'is_show' => 0,
                    'is_create' => 0,
                    'is_edit' => 0,
                    'is_delete' => 0,
                ], $permissionData);

                Permission::updateOrCreate(
                    [
                        'role_id' => $role->id,
                        'menu_id' => $menuId,
                    ],
                    [
                        'is_listing' => $permissionData['is_listing'],
                        'is_show' => $permissionData['is_show'],
                        'is_create' => $permissionData['is_create'],
                        'is_edit' => $permissionData['is_edit'],
                        'is_delete' => $permissionData['is_delete'],
                    ]
                );
            }
            // -------------------- permissions --------------------------
            DB::commit();
            return redirect()->route('roles.index')->with('success', 'Providers create successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the property. Please try again.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roles = Role::findOrFail($id);
        $roles->softDeleteRelations();
        return redirect()->route('roles.index')->with('success', 'user have been soft deleted successfully');
    }
    public function export(Request $request)
    {
        // Fetch data dynamically based on request filters
        $query = DB::table('roles')
            ->select('id', 'name', 'status','created_at');
    
        // Apply filters (if passed in the request)
        if ($request->has('start_date')) {
            $query->where('created_at', '>=', $request->start_date);
        }
    
        if ($request->has('end_date')) {
            $query->where('created_at', '<=', $request->end_date);
        }
    
        // Get the filtered data
        $data = $query->get();
    
        // Check if there are any users to export
        if ($data->isEmpty()) {
            return response()->json(['message' => 'No users found for the given criteria.'], 404);
        }
    
        // Prepare CSV headers
        $csvData = "ID,Name,Status,Created At\n";
    
        // Loop through the users and append data to CSV
        foreach ($data as $value) {
            // Format the creation date
            $createdAt = Carbon::parse($value->created_at)->format('M d, Y g:i A'); // Format as 'Sep 30, 2024 3:45 PM'
            if($value->status){
                $status = 'Active';
            }else{
                $status = "In Active";
            }
            // Append data to CSV
            $csvData .= '"' . implode('","', [
                $this->sanitizeForCsv($value->id),
                $this->sanitizeForCsv($value->name),
                $status,
                $createdAt
            ]) . "\"\n";
        }
    
        // Set the filename with a timestamp
        $fileName = 'Role_export_' . now()->format('Y_m_d_H_i_s') . '.csv';
    
        // Return the CSV response with proper headers
        return Response::make($csvData, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ]);
    }
    
    private function sanitizeForCsv($value)
    {
        if ($value === null) {
            return '';
        }
        // Escape double quotes
        return str_replace('"', '""', $value);
    }

    public function import(Request $request)
    {   
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);
        $file = $request->file('csv_file');
        $path = $file->getRealPath();
        DB::beginTransaction(); // Start a database transaction
        try {
            if (($handle = fopen($path, 'r')) !== false) {
                $header = fgetcsv($handle, 1000, ','); // Get the first row as headers
                
                while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                    
                    if (count($header) !== count($row)) {
                        continue;
                    }
                    
                    $data = array_combine($header, $row);
                    
                    // Check for duplicate records based on unique columns
                    $exists = Role::where('name', $data['Name'] ?? null)
                        ->exists();
                    
                    if ($exists) {
                        continue; // Skip this row if a duplicate record exists
                    }         
                    
                    if($data['Status'] == 'Active'){
                        $status = 1;
                    }else{
                        $status = 0;
                    }

                    // Map CSV data to database fields
                    $role = [
                        'name' => $data['Name'] ?? null,
                        'staus' => $status
                    ];    
                    // Save the property
                    Role::create($role);
                }
                fclose($handle);
            }
            DB::commit(); // Commit the transaction if everything is successful
            return back()->with('success', 'CSV imported successfully!');
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack(); // Roll back the transaction on error
            return back()->withErrors(['error' => 'Failed to import CSV: ' . $e->getMessage()]);
        }
    }
}
