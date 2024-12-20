<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use App\Models\Membership;
use App\Models\PlanMenu;
use App\Models\PlanPermission;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allow_show = Helper::check_rights(13)->is_show;
        $allow_create = Helper::check_rights(13)->is_create;
        $allow_edit = Helper::check_rights(13)->is_edit;
        $allow_delete = Helper::check_rights(13)->is_delete;

        $query = Membership::query();
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('price')) {
            $query->where('price', 'like', '%' . $request->price . '%');
        }

        if ($request->filled('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('price', 'like', '%' . $request->search . '%')
                        ->orWhere('plan_type', 'like', '%' . $request->search . '%');
            });
        }

        $memberships = $query->active()->paginate(10);

        return view('livewire.memberships.index', compact('memberships','allow_show','allow_create','allow_edit','allow_delete'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('livewire.memberships.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'  => 'required|string|max:255',
                'price'  => 'required',
                'features'  => 'required|string|max:255',
                'description'  => 'required|string|max:255',
                'stripe_id' => 'nullable|string|max:255',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            DB::beginTransaction();
            Membership::create([
                'name' => $request->name,
                'price' => $request->price,
                'features' => $request->features,
                'description' => $request->description,
                'plan_type'=> $request->plan_type,
                'stripe_id'=> $request->stripe_id,
            ]);
            DB::commit();
            return redirect()->route('memberships.index')->with('success', 'membership create successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the membership. Please try again.']);
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
        $membership = Membership::findOrFail($id);
        return view('livewire.memberships.show', compact('membership'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $membership = Membership::findOrFail($id);
        return view('livewire.memberships.edit', compact('membership'));
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
        try {
            $validator = Validator::make($request->all(), [
                'name'  => 'required|string|max:255',
                'price'  => 'required|string|max:255',
                'features'  => 'required|string|max:255',
                'description'  => 'required|string|max:255',
                'stripe_id' => 'nullable|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            DB::beginTransaction();
            $membership = Membership::findOrFail($id);
            $membership->update([
                'name' => $request->name,
                'price' => $request->price,
                'features' => $request->features,
                'description' => $request->description,
                'plan_type'=> $request->plan_type,
                'stripe_id'=> $request->stripe_id,
            ]);
            DB::commit();
            return redirect()->route('memberships.index')->with('success', 'membership update successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the membership. Please try again.']);
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
        $membership = Membership::findOrFail($id);
        $membership->softDeleteRelations();
        return redirect()->route('memberships.index')->with('success', 'user have been soft deleted successfully');
    }

    public function assign_permission($plan_id)
    {
        
        $membership = Membership::NameWithPrice();
        $plan_menus = PlanMenu::active()->get();
        $plan_permissions = PlanPermission::where('plan_id',$plan_id)->get();

        return view('livewire.memberships.plan_permission',compact('membership','plan_menus','plan_permissions','plan_id'));
    }

    public function post_assign_permission(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'plan_id' => 'required',
                'plan_menu_id' => 'required|array',
                'permissions' => 'array',
                'permissions.*.is_view' => 'nullable|boolean',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            
            // -------------------- permissions --------------------------
            $permissions = $request->input('permissions', []);
            PlanPermission::where('plan_id', $request->plan_id)->update(['is_view' => 0]);
            foreach ($permissions as $menuId => $permissionData) {

                $permissionData = array_merge([
                    'is_view' => 0,
                ], $permissionData);

                PlanPermission::updateOrCreate(
                    [
                        'plan_id' => $request->plan_id,
                        'plan_menu_id' => $menuId,
                    ],
                    [
                        'is_view' => $permissionData['is_view'],
                    ]
                );
            }
            // -------------------- permissions --------------------------
            DB::commit();
            return redirect()->route('memberships.index')->with('success', 'Permissions assigned successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function export(Request $request)
    {
        // Fetch data dynamically based on request filters
        $query = DB::table('memberships')
            ->select('id','stripe_id','name','price','features','description','status','plan_type','created_at');
    
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
        $csvData = "ID,Stripe Id,Name,Price,Features,Description,Status,Plan Type,Created At\n";
    
        // Loop through the users and append data to CSV
        foreach ($data as $value) {
            // Format the creation date
            $createdAt = Carbon::parse($value->created_at)->format('M d, Y g:i A'); // Format as 'Sep 30, 2024 3:45 PM'
            if($value->status) 
                $status = 'Active';
            else
                $status= 'In Active';
            
            $csvData .= '"' . implode('","', [
                $this->sanitizeForCsv($value->id),
                $this->sanitizeForCsv($value->stripe_id),
                $this->sanitizeForCsv($value->name),
                $this->sanitizeForCsv($value->price),
                $this->sanitizeForCsv($value->features),
                $this->sanitizeForCsv($value->description),
                $this->sanitizeForCsv($status),
                $this->sanitizeForCsv($value->plan_type),
                $createdAt
                ]) . "\"\n";
        }
    
        // Set the filename with a timestamp
        $fileName = 'Membership_export_' . now()->format('Y_m_d_H_i_s') . '.csv';
    
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
                    $exists = Membership::where('name', $data['Name'] ?? null)
                        ->where('price', $data['Price'] ?? null)
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
                    $membership = [
                        'name' => $data['Name'] ?? null,
                        'price' => $data['Price'] ?? null,
                        'features' => $data['Features'] ?? null,
                        'description' => $data['Description'] ?? null,
                        'plan_type'=> $data['Plan Type'] ?? null,
                        'stripe_id'=> $data['Stripe Id'] ?? null,
                        'status' => $status
                    ];
                    // Save the property
                    Membership::create($membership);
                }
                fclose($handle);
            }
            DB::commit(); // Commit the transaction if everything is successful
            return back()->with('success', 'CSV imported successfully!');
        } catch (\Exception $e) {
            DB::rollBack(); // Roll back the transaction on error
            dd($e->getMessage());
            return back()->withErrors(['error' => 'Failed to import CSV: ' . $e->getMessage()]);
        }
    }
}
