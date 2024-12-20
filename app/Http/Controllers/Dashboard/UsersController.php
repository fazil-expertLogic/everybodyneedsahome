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
use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allow_show = Helper::check_rights(5)->is_show;
        $allow_create = Helper::check_rights(5)->is_create;
        $allow_edit = Helper::check_rights(5)->is_edit;
        $allow_delete = Helper::check_rights(5)->is_delete;

        // $query = User::active();
        $query = User::query();
        
        if ($request->filled('property_type')) {
            $query->where('property_type', 'like', '%' . $request->property_type . '%');
        }
        
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
    
        if ($request->filled('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('name', 'like', '%' . $request->search . '%')
                         ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }
        $users = $query->active()->paginate(10);    
        return view('livewire.user.index', compact('users','allow_show','allow_create','allow_edit','allow_delete'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::active()->get();
        return view('livewire.user.add',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'pass' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
            // return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->pass), 
                'role_id' => $request->role,
            ]);
            DB::commit();
            return redirect()->route('users.index')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            $e->getMessage();
            return redirect()->back()->with('error', 'Failed to create user. Please try again.');
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
        $user = User::findOrFail($id); // Fetch property by ID
        $roles = Role::active()->get();
        return view('livewire.user.show', compact('user','roles')); // Return edit view
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id); // Fetch property by ID
        $roles = Role::active()->get();
        return view('livewire.user.edit', compact('user','roles')); // Return edit view
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'pass' => 'string|min:8|confirmed',
            'role' => 'required|exists:roles,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
            // return redirect()->back()->withErrors($validator)->withInput();
        }
       
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $user->update([   
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->pass), 
                'role_id' => $request->role,
            ]);
            DB::commit();
            return redirect()->route('users.index')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Failed to create user. Please try again.');
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
        $user = User::findOrFail($id);
        $user->softDeleteRelations();
        return redirect()->route('users.index')->with('success', 'user have been soft deleted successfully');
    }
    public function export(Request $request)
    {
        // Fetch data dynamically based on request filters
        $query = DB::table('users')
            ->select('id', 'is_online','name','email','password', 'role_id','created_at');
    
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
        $csvData = "ID,Is Online,Name,Email,Role Id,Created At\n";
    
        // Loop through the users and append data to CSV
        foreach ($data as $value) {
            // Format the creation date
            $createdAt = Carbon::parse($value->created_at)->format('M d, Y g:i A'); // Format as 'Sep 30, 2024 3:45 PM'
    
            // Append data to CSV

            if($value->is_online){
                $is_online = 'Online';
            }else{
                $is_online = "Not Online";
            }

            $csvData .= '"' . implode('","', [
                $this->sanitizeForCsv($value->id),
                $this->sanitizeForCsv($is_online),
                $this->sanitizeForCsv($value->name),
                $this->sanitizeForCsv($value->email),
                $this->sanitizeForCsv($value->role_id),
                $createdAt
            ]) . "\"\n";
        }
    
        // Set the filename with a timestamp
        $fileName = 'users_export_' . now()->format('Y_m_d_H_i_s') . '.csv';
    
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
                    $exists = User::where('name', $data['Name'] ?? null)
                        ->where('email', $data['Email'] ?? null)
                        ->exists();
                    
                    if ($exists) {
                        continue; // Skip this row if a duplicate record exists
                    }         

                    if($data['Is Online'] == 'Online'){
                        $Online = 1;
                    }else{
                        $Online = 0;
                    }

                    // Map CSV data to database fields
                    $user = [
                        'is_online' => $Online,
                        'name' => $data['Name'],
                        'email' => $data['Email'],
                        'role_id' => $data['Role Id'],
                    ];    
                    // Save the property
                    User::create($user);
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
