<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Models\Guest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allow_show = Helper::check_rights(18)->is_show;
        $allow_create = Helper::check_rights(18)->is_create;
        $allow_edit = Helper::check_rights(18)->is_edit;
        $allow_delete = Helper::check_rights(18)->is_delete;

        $query = Guest::query();
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

        $guests = $query->active()->paginate(10);

        return view('livewire.guests.index', compact('guests','allow_show','allow_create','allow_edit','allow_delete'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('livewire.guests.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation Rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'ssn' => 'required|string',
            'dob' => 'required|date',
            'address' => 'required|string|max:255',
            'address2' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip_code' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|unique:users|string|max:100',
            'evicted' => 'required',
            'eviction_property_name' => 'nullable|string|max:255',
            'eviction_manager_name' => 'nullable|string|max:255',
            'eviction_address' => 'nullable|string|max:255',
            'eviction_phone' => 'nullable|string',
            'eviction_date' => 'nullable|date',
            'eviction_comments' => 'nullable|string',
            'convicted' => 'required',
            'conviction_year' => 'nullable|string',
            'conviction_charge' => 'nullable|string|max:255',
            'conviction_sentence' => 'nullable|string|max:255',
            'sex_offender' => 'required',
            'victim_minor' => 'nullable',
            'age_difference' => 'nullable|string|max:255',
            'probation' => 'required',
            'probation_officer_name' => 'nullable|string|max:255',
            'probation_officer_phone' => 'nullable|string',
            'probation_officer_email' => 'nullable|email',
            'ref1_name' => 'nullable|string|max:255',
            'ref1_phone' => 'nullable|string',
            'ref1_email' => 'nullable|email',
            'ref2_name' => 'nullable|string|max:255',
            'ref2_phone' => 'nullable|string',
            'ref2_email' => 'nullable|email',
            'ref3_name' => 'nullable|string|max:255',
            'ref3_phone' => 'nullable|string',
            'ref3_email' => 'nullable|email',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string',
            'emergency_contact_email' => 'required|email',
            'employer_name' => 'nullable|string|max:255',
            'employer_phone' => 'nullable|string',
            'income' => 'nullable|numeric',
            'expenses' => 'nullable|numeric',
            'rental_budget' => 'nullable|numeric',
            'pass' => 'required|string|min:8|confirmed',
        ]);

        // Check Validation
        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        }

        // Database Transaction
        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->pass),
                'role_id' => "7",
            ]);

            $guest = Guest::create([
                'name' => $request->name,
                'ssn' => $request->ssn,
                'dob' => $request->dob,
                'address' => $request->address,
                'address2' => $request->address2,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip_code,
                'phone' => $request->phone,
                'email' => $request->email,
                'evicted' => $request->evicted,
                'eviction_property_name' => $request->eviction_property_name,
                'eviction_manager_name' => $request->eviction_manager_name,
                'eviction_address' => $request->eviction_address,
                'eviction_phone' => $request->eviction_phone,
                'eviction_date' => $request->eviction_date,
                'eviction_comments' => $request->eviction_comments,
                'convicted' => $request->convicted,
                'conviction_year' => $request->conviction_year,
                'conviction_charge' => $request->conviction_charge,
                'conviction_sentence' => $request->conviction_sentence,
                'sex_offender' => $request->sex_offender,
                'probation' => $request->probation,
                'probation_officer_name' => $request->probation_officer_name,
                'probation_officer_phone' => $request->probation_officer_phone,
                'probation_officer_email' => $request->probation_officer_email,
                'ref1_name' => $request->ref1_name,
                'ref1_phone' => $request->ref1_phone,
                'ref1_email' => $request->ref1_email,
                'emergency_contact_name' => $request->emergency_contact_name,
                'emergency_contact_phone' => $request->emergency_contact_phone,
                'emergency_contact_email' => $request->emergency_contact_email,
                'employer_name' => $request->employer_name,
                'employer_phone' => $request->employer_phone,
                'income' => $request->income,
                'expenses' => $request->expenses,
                'rental_budget' => $request->rental_budget,
                'user_id' => $user->id,
            ]);

            // Commit Transaction
            DB::commit();
            if($request->front){
                return redirect()->route('index')->with('success', 'Gust Add successfully.');    
            }
            return redirect()->route('guests.index')->with('success', 'Gust Add successfully.');

        } catch (\Exception $e) {
            // Rollback Transaction
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to create guest',
                'error' => $e->getMessage(),
            ], 500);
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
        $guest = Guest::findOrFail($id);
        return view('livewire.guests.show', compact('guest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guest = Guest::findOrFail($id);
        return view('livewire.guests.edit', compact('guest'));
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
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'ssn' => "required|string",
            'dob' => 'required|date',
            'address' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip_code' => 'required|string|max:10',
            'phone' => 'required|string',
            // 'email' => "required|string|max:100|unique:users,email,{$request->user_id}",
            'evicted' => 'required',
            'eviction_property_name' => 'nullable|string|max:255',
            'eviction_manager_name' => 'nullable|string|max:255',
            'eviction_address' => 'nullable|string|max:255',
            'eviction_phone' => 'nullable|string',
            'eviction_date' => 'nullable|date',
            'eviction_comments' => 'nullable|string',
            'convicted' => 'required',
            'conviction_year' => 'nullable|string|max:4',
            'conviction_charge' => 'nullable|string|max:255',
            'conviction_sentence' => 'nullable|string|max:255',
            'sex_offender' => 'required',
            'victim_minor' => 'nullable',
            'age_difference' => 'nullable|string|max:255',
            'probation' => 'required',
            'probation_officer_name' => 'nullable|string|max:255',
            'probation_officer_phone' => 'nullable|string',
            'probation_officer_email' => 'nullable|email',
            'ref1_name' => 'nullable|string|max:255',
            'ref1_phone' => 'nullable|string',
            'ref1_email' => 'nullable|email',
            'ref2_name' => 'nullable|string|max:255',
            'ref2_phone' => 'nullable|string',
            'ref2_email' => 'nullable|email',
            'ref3_name' => 'nullable|string|max:255',
            'ref3_phone' => 'nullable|string',
            'ref3_email' => 'nullable|email',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string',
            'emergency_contact_email' => 'required|email',
            'employer_name' => 'nullable|string|max:255',
            'employer_phone' => 'nullable|string',
            'income' => 'nullable|numeric',
            'expenses' => 'nullable|numeric',
            'rental_budget' => 'nullable|numeric',
            'pass' => 'nullable|string|min:8|confirmed',
        ]);

        // Check Validation
        if ($validator->fails()) {
            dd($validator->errors());
            return back()->withErrors($validator)->withInput();
        }

        // Database Transaction
        DB::beginTransaction();

        try {
            // Find the guest and user records by ID
            $guest = Guest::findOrFail($id);
            $user = User::findOrFail($guest->user_id);

            // Update User data
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->pass ? Hash::make($request->pass) : $user->password,
            ]);

            // Update Guest data
            $guest->update([
                'name' => $request->name,
                'ssn' => $request->ssn,
                'dob' => $request->dob,
                'address' => $request->address,
                'address2' => $request->address2,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip_code,
                'phone' => $request->phone,
                'email' => $request->email,
                'evicted' => $request->evicted,
                'eviction_property_name' => $request->eviction_property_name,
                'eviction_manager_name' => $request->eviction_manager_name,
                'eviction_address' => $request->eviction_address,
                'eviction_phone' => $request->eviction_phone,
                'eviction_date' => $request->eviction_date,
                'eviction_comments' => $request->eviction_comments,
                'convicted' => $request->convicted,
                'conviction_year' => $request->conviction_year,
                'conviction_charge' => $request->conviction_charge,
                'conviction_sentence' => $request->conviction_sentence,
                'sex_offender' => $request->sex_offender,
                'victim_minor' => $request->victim_minor,
                'age_difference' => $request->age_difference,
                'probation' => $request->probation,
                'probation_officer_name' => $request->probation_officer_name,
                'probation_officer_phone' => $request->probation_officer_phone,
                'probation_officer_email' => $request->probation_officer_email,
                'ref1_name' => $request->ref1_name,
                'ref1_phone' => $request->ref1_phone,
                'ref1_email' => $request->ref1_email,
                'ref2_name' => $request->ref2_name,
                'ref2_phone' => $request->ref2_phone,
                'ref2_email' => $request->ref2_email,
                'ref3_name' => $request->ref3_name,
                'ref3_phone' => $request->ref3_phone,
                'ref3_email' => $request->ref3_email,
                'emergency_contact_name' => $request->emergency_contact_name,
                'emergency_contact_phone' => $request->emergency_contact_phone,
                'emergency_contact_email' => $request->emergency_contact_email,
                'employer_name' => $request->employer_name,
                'employer_phone' => $request->employer_phone,
                'income' => $request->income,
                'expenses' => $request->expenses,
                'rental_budget' => $request->rental_budget,
            ]);

            // Commit Transaction
            DB::commit();
            return redirect()->route('guests.index')->with('success', 'Guest updated successfully.');

        } catch (\Exception $e) {
            // Rollback Transaction
            DB::rollBack();
            dd($e->getMessage());
            return response()->json([
                'message' => 'Failed to update guest',
                'error' => $e->getMessage(),
            ], 500);
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
        $guest = Guest::findOrFail($id);
        $guest->softDeleteRelations();
        return redirect()->route('guests.index')->with('success', 'user have been soft deleted successfully');
    }
    
    public function guest_registration_website()
    {
        $page_content = Helper::pageContent('guest-registration');
        return view('site.guest-registration',compact('page_content'));
    }
    
    public function export(Request $request)
    {
        $query = DB::table('guests')
            ->select('id','name','ssn','dob','address','address2','city','state','zip','phone','email','evicted','eviction_property_name','eviction_manager_name','eviction_address','eviction_phone','eviction_date','eviction_comments','convicted','conviction_year','conviction_charge','conviction_sentence','sex_offender','probation','probation_officer_name','probation_officer_phone','probation_officer_email','ref1_name','ref1_phone','ref1_email','ref2_name','ref2_phone','ref2_email','ref3_name','ref3_phone','ref3_email','emergency_contact_name','emergency_contact_phone','emergency_contact_email','employer_name','employer_phone','income','expenses','rental_budget','user_id','created_at');

        if ($request->has('start_date')) {
            $query->where('created_at', '>=', $request->start_date);
        }
    
        if ($request->has('end_date')) {
            $query->where('created_at', '<=', $request->end_date);
        }
    

        $data = $query->get();
    
        // Check if there are any users to export
        if ($data->isEmpty()) {
            return response()->json(['message' => 'No users found for the given criteria.'], 404);
        }
    
        // Prepare CSV headers
        $csvData = "ID,Tenant Name,Social Security Number,Date Of Birth,Address,Address2,City,State,Zip Code,Phone,Email,Evicted,Eviction Property Name,Eviction Manager Name,Eviction Address,Eviction Phone,Eviction Date,Eviction Comments,Convicted,Conviction Year,Conviction Charge,Conviction Sentence,Sex Offender,Probation,Probation Officer Name,Probation Officer Phone,Probation Officer Email,Ref1 Name,Ref1 Phone,Ref1 Email,Ref2 Name,Ref2 Phone,Ref2 Email,Ref3 Name,Ref3 Phone,Ref3 Email,Emergency Contact Name,Emergency Contact Phone,Emergency Contact Email,Employer Name,Employer Phone,Monthly Income ($),Monthly Expenses ($),Monthly Rental Budget ($),User ID,Created At\n";

    
        // Loop through the users and append data to CSV
        foreach ($data as $value) {
            // Format the creation date
            $createdAt = Carbon::parse($value->created_at)->format('M d, Y g:i A'); // Format as 'Sep 30, 2024 3:45 PM'

            if($value->evicted == 1){
                $evicted = 'Yes';
            }else{
                $evicted = 'No';
            }

            if($value->convicted == 1){
                $convicted = 'Yes';
            }else{
                $convicted = 'No';
            }

            if($value->sex_offender == 1){
                $sex_offender = 'Yes';
            }else{
                $sex_offender = 'No';
            }
            $csvData .= '"' . implode('","', [
                // ---------------------------------
                $this->sanitizeForCsv($value->id),
                $this->sanitizeForCsv($value->name),
                $this->sanitizeForCsv($value->ssn),
                $this->sanitizeForCsv($value->dob),
                $this->sanitizeForCsv($value->address),
                $this->sanitizeForCsv($value->address2),
                $this->sanitizeForCsv($value->city),
                $this->sanitizeForCsv($value->state),
                $this->sanitizeForCsv($value->zip),
                $this->sanitizeForCsv($value->phone),
                $this->sanitizeForCsv($value->email),
                $this->sanitizeForCsv($evicted),
                $this->sanitizeForCsv($value->eviction_property_name),
                $this->sanitizeForCsv($value->eviction_manager_name),
                $this->sanitizeForCsv($value->eviction_address),
                $this->sanitizeForCsv($value->eviction_phone),
                $this->sanitizeForCsv($value->eviction_date),
                $this->sanitizeForCsv($value->eviction_comments),
                $this->sanitizeForCsv($convicted),
                $this->sanitizeForCsv($value->conviction_year),
                $this->sanitizeForCsv($value->conviction_charge),
                $this->sanitizeForCsv($value->conviction_sentence),
                $this->sanitizeForCsv($sex_offender),
                $this->sanitizeForCsv($value->probation),
                $this->sanitizeForCsv($value->probation_officer_name),
                $this->sanitizeForCsv($value->probation_officer_phone),
                $this->sanitizeForCsv($value->probation_officer_email),
                $this->sanitizeForCsv($value->ref1_name),
                $this->sanitizeForCsv($value->ref1_phone),
                $this->sanitizeForCsv($value->ref1_email),
                $this->sanitizeForCsv($value->ref2_name),
                $this->sanitizeForCsv($value->ref2_phone),
                $this->sanitizeForCsv($value->ref2_email),
                $this->sanitizeForCsv($value->ref3_name),
                $this->sanitizeForCsv($value->ref3_phone),
                $this->sanitizeForCsv($value->ref3_email),
                $this->sanitizeForCsv($value->emergency_contact_name),
                $this->sanitizeForCsv($value->emergency_contact_phone),
                $this->sanitizeForCsv($value->emergency_contact_email),
                $this->sanitizeForCsv($value->employer_name),
                $this->sanitizeForCsv($value->employer_phone),
                $this->sanitizeForCsv($value->income),
                $this->sanitizeForCsv($value->expenses),
                $this->sanitizeForCsv($value->rental_budget),
                $this->sanitizeForCsv($value->user_id),
                $createdAt
                // ------------------------------------
            ]) . "\"\n";
        }
    
        // Set the filename with a timestamp
        $fileName = 'Tenant_export_' . now()->format('Y_m_d_H_i_s') . '.csv';
    
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
                    $exists = Guest::where('name', $data['Tenant Name'] ?? null)
                        ->where('email', $data['Email'] ?? null)
                        ->where('ssn', $data['Social Security Number'] ?? null)
                        ->exists();

                    $user_exists = User::where('name', $data['Tenant Name'] ?? null)
                        ->where('email', $data['Email'] ?? null)
                        ->exists();
                    
                    if ($exists && $user_exists) {
                        continue; // Skip this row if a duplicate record exists
                    }

                    if($data['Evicted'] == 'Yes'){
                        $evicted = 1;
                    }else{
                        $evicted = 2;
                    }

                    if($data['Convicted'] == 'Yes'){
                        $convicted = 1;
                    }else{
                        $convicted = 2;
                    }
                    
                    if($data['Sex Offender'] == 'Yes'){
                        $sex_offender = 1;
                    }else{
                        $sex_offender = 2;
                    }

                    $user = User::create([
                        'name' => $data['Tenant Name'],
                        'email' => $data['Email'],
                        'password' => Hash::make('Pa$$w0rd!'),
                        'role_id' => "7",
                    ]);
                    
                    // Map CSV data to database fields
                    $guest = [
                        'name' => $data['Tenant Name'],
                        'ssn' => $data['Social Security Number'],
                        'dob' => $data['Date Of Birth'] = !empty($data['Date Of Birth']) ? Carbon::createFromFormat('m/d/Y', $data['Date Of Birth'])->format('Y-m-d') : null,
                        'address' => $data['Address'],
                        'address2' => $data['Address2'],
                        'city' => $data['City'],
                        'state' => $data['State'],
                        'zip' => $data['Zip Code'],
                        'phone' => $data['Phone'],
                        'email' => $data['Email'],
                        'evicted' => $evicted,
                        'eviction_property_name' => $data['Eviction Property Name'],
                        'eviction_manager_name' => $data['Eviction Manager Name'],
                        'eviction_address' => $data['Eviction Address'],
                        'eviction_phone' => $data['Eviction Phone'],
                        'eviction_date' => !empty($data['Eviction Date']) ? Carbon::createFromFormat('m/d/Y', $data['Eviction Date'])->format('Y-m-d') : null,
                        'eviction_comments' => $data['Eviction Comments'],
                        'convicted' => $convicted,
                        'conviction_year' => $data['Conviction Year'],
                        'conviction_charge' => $data['Conviction Charge'],
                        'conviction_sentence' => $data['Conviction Sentence'],
                        'sex_offender' => $sex_offender,
                        'probation' => $data['Probation'],
                        'probation_officer_name' => $data['Probation Officer Name'],
                        'probation_officer_phone' => $data['Probation Officer Phone'],
                        'probation_officer_email' => $data['Probation Officer Email'],
                        'ref1_name' => $data['Ref1 Name'],
                        'ref1_phone' => $data['Ref1 Phone'],
                        'ref1_email' => $data['Ref1 Email'],
                        'ref2_name' => $data['Ref2 Name'],
                        'ref2_phone' => $data['Ref2 Phone'],
                        'ref2_email' => $data['Ref2 Email'],
                        'ref3_name' => $data['Ref3 Name'],
                        'ref3_phone' => $data['Ref3 Phone'],
                        'ref3_email' => $data['Ref3 Email'],
                        'emergency_contact_name' => $data['Emergency Contact Name'],
                        'emergency_contact_phone' => $data['Emergency Contact Phone'],
                        'emergency_contact_email' => $data['Emergency Contact Email'],
                        'employer_name' => $data['Employer Name'],
                        'employer_phone' => $data['Employer Phone'],
                        'income' => $data['Monthly Income ($)'],
                        'expenses' => $data['Monthly Expenses ($)'],
                        'rental_budget' => $data['Monthly Rental Budget ($)'],
                        'user_id' => $user->id,
                    ];    
                    // Save the property
                    Guest::create($guest);
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
