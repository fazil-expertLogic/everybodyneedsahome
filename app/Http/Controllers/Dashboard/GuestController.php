<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Guest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('livewire.guest.add');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function guest_registration_website()
    {
        return view('site.guest-registration');
    }
}
