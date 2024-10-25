<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Client;
use App\Models\ClientChild;
use App\Models\ClientCriminalHistory;
use App\Models\ClientInfo;
use App\Models\ClientSurvey;
use App\Models\ClientsHealthIns;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::paginate(10);
        return view('livewire.client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('livewire.client.add');
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
            'cus_name' => 'required|string|max:255',
            'cus_email' => 'required|email|max:255',
            'cus_dob' => 'required|date',
            'cus_ss' => 'required|string|max:9',
            'martial_status' => 'required|in:1,2,3', // Adjust options based on possible statuses
            'cus_is_child' => 'required|in:1,2',
            // 'child_name' => 'array',
            // 'child_name.*' => 'string|max:255',
            // 'child_age' => 'array',
            // 'child_age.*' => 'integer|min:0|max:18',
            'cus_address' => 'required|string|max:255',
            'cus_city' => 'required|string|max:255',
            'cus_state' => 'required|string|max:2',
            'cus_zip' => 'required|string|max:5',
            'cus_phone' => 'required|string|max:20',
            'role' => 'required|in:1,2,3', // Adjust options based on possible roles
            'cus_dfc' => 'required|date',
            'cus_con' => 'required|string|max:255',
            'cus_conq' => 'required|in:1,2',
            'cus_sex_off' => 'required|in:1,2',
            'cus_is_offend_minor' => 'required|in:1,0',
            'cus_food' => 'required|in:1,0',
            'cus_cloth' => 'required|in:1,0',
            'cus_shelter' => 'required|in:1,0',
            'cus_tra' => 'required|in:1,0',
            'cus_emp' => 'required|in:1,2',
            'cus_extra_income' => 'required|in:1,2',
            'cus_church' => 'required|string|max:255',
            'cus_other_church' => 'nullable|string|max:255',
            'cus_bcert' => 'required|in:1,0',
            'cus_born_state' => 'required|string|max:2',
            'cus_state_id' => 'required|in:1,0',
            'cus_state_no' => 'nullable|string|max:25',
            'cus_d_lice' => 'required|in:1,0',
            'cus_lice_no' => 'nullable|string|max:255',
            'cus_ss_card' => 'required|in:1,0',
            'cus_ssc_no' => 'nullable|string|max:255',
            'cus_insurace' => 'required|in:1,2',
            'cus_carrier' => 'nullable|string|max:255',
            'cus_mem_id' => 'nullable|string|max:255',
            'cus_grp_no' => 'nullable|string|max:255',
            'cus_more_friends' => 'required|in:1,2',
            'cus_counselor' => 'nullable|string|max:255',
            'cus_is_inv_rom' => 'required|in:1,0',
            'cus_is_mental_ill' => 'required|in:1,0',
            'cus_phy_dis' => 'nullable|string|max:255',
            'cus_comments' => 'nullable|string|max:255',
        ]);
        
        if ($validator->fails()) {
            dd($validator->errors());
            return response()->json($validator->errors(), 422);
        }
        
        DB::beginTransaction(); // Start the transaction

        try {
             // Create the property record
            $client = Client::create([
                'cus_name' => $request->cus_name ?? '',
                'email' => $request->cus_email ?? '',
                'cus_dob' => $request->cus_dob ?? '',
                'cus_ss' => $request->cus_ss ?? '',
                'martial_status' => $request->martial_status ?? '',
                'is_child' => $request->cus_is_child ?? '',
                'address' => $request->cus_address ?? '',
                'city' => $request->cus_city ?? '',
                'state' => $request->cus_state ?? '',
                'zipcode' => $request->cus_zip ?? '',
                'phone' => $request->cus_phone ?? '',
            ]);

            foreach($request->child_name as $child){
                ClientChild::create([
                    'gl_ID' => $client->id ?? '',
                    'child_name' => $child->child_name ?? '',
                    'child_age' => $child->child_age ?? '',
                ]);
            }
            
            ClientCriminalHistory::create([
                'gl_ID' => $client->id ?? '',
                'role' => $request->role ?? '',
                'date_of_con' => $request->cus_dfc ?? '',
                'conviction'=> $request->cus_con ?? '',
                'conq' => $request->cus_conq ?? '',
                'is_sex_off' => $request->cus_sex_off ?? '',
                'is_offend_minor' => $request->cus_is_offend_minor ?? '',
            ]);

            ClientCriminalHistory::create([
                'gl_ID' => $client->id ?? '',
                'role' => $request->role ?? '',
                'date_of_con' => $request->cus_dfc ?? '',
                'conviction'=> $request->cus_con ?? '',
                'conq' => $request->cus_conq ?? '',
                'is_sex_off' => $request->cus_sex_off ?? '',
                'is_offend_minor' => $request->cus_is_offend_minor ?? '',
            ]);

            ClientSurvey::create([
                'gl_ID'  => $client->id ?? '',
                'is_food' => $request->cus_food ?? '',
                'is_cloth' => $request->cus_cloth ?? '',
                'is_shelter' => $request->cus_shelter ?? '',
                'is_transport' => $request->cus_tra ?? '',
                'is_emp' => $request->cus_emp ?? '',
                'extra_incom' => $request->cus_extra_income ?? '',
                'church' => $request->cus_church ?? '',
                'custom_church' => $request->cus_other_church ?? '',
                'is_bcert' => $request->cus_bcert ?? '',
                'state_name' => $request->cus_born_state ?? '',
                'is_state_id' => $request->cus_state_id ?? '',
                'stateIDno' => $request->cus_state_no ?? '',
                'is_DL' => $request->cus_d_lice ?? '',
                'DlicenseNo' => $request->cus_lice_no ?? '',
                'is_ss_card' => $request->cus_ss_card ?? '',
                'ss_number' => $request->cus_ssc_no ?? '',
            ]);

            ClientsHealthIns::create([
                'gl_ID' => $client->id ?? '',
                'is_health'=> $request->cus_insurace ?? '',
                'carrier'=> $request->cus_carrier ?? '',
                'mem_id'=> $request->cus_mem_id ?? '',
                'grp_no'=> $request->cus_grp_no ?? '',
            ]);
            ClientInfo::create([
                'gl_ID' => $client->id ?? '',
                'more_friends'=> $request->cus_more_friends,
                'counselor'=> $request->cus_counselor,
                'is_inv_rom'=> $request->cus_is_inv_rom,
                'is_mental_ill'=> $request->cus_is_mental_ill,
                'phy_dis'=> $request->cus_phy_dis,
                'comments'=> $request->cus_comments,
            ]);
            
            DB::commit(); // Commit the transaction if everything works
            return redirect()->route('properties.index')->with('success', 'Property updated successfully.');
        } catch (\Exception $e) {

            DB::rollBack(); // Rollback if any operation fails
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the property. Please try again.']);
        }
        // Redirect or return a response
        return redirect()->route('clients.index')->with('success', 'Property created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::WithAllRelations()->findOrFail($id); // Fetch property by ID
        dd($client);
        return view('livewire.client.show', compact('client')); // Return edit view
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
        $validator = Validator::make($request->all(), [
            'cus_name' => 'required|string|max:255',
            'cus_email' => 'required|email|max:255',
            'cus_dob' => 'required|date',
            'cus_ss' => 'required|string|max:9',
            'martial_status' => 'required|in:1,2,3', // Adjust options based on possible statuses
            'cus_is_child' => 'required|in:1,2',
            // 'child_name' => 'array',
            // 'child_name.*' => 'string|max:255',
            // 'child_age' => 'array',
            // 'child_age.*' => 'integer|min:0|max:18',
            'cus_address' => 'required|string|max:255',
            'cus_city' => 'required|string|max:255',
            'cus_state' => 'required|string|max:2',
            'cus_zip' => 'required|string|max:5',
            'cus_phone' => 'required|string|max:20',
            'role' => 'required|in:1,2,3', // Adjust options based on possible roles
            'cus_dfc' => 'required|date',
            'cus_con' => 'required|string|max:255',
            'cus_conq' => 'required|in:1,2',
            'cus_sex_off' => 'required|in:1,2',
            'cus_is_offend_minor' => 'required|in:1,0',
            'cus_food' => 'required|in:1,0',
            'cus_cloth' => 'required|in:1,0',
            'cus_shelter' => 'required|in:1,0',
            'cus_tra' => 'required|in:1,0',
            'cus_emp' => 'required|in:1,2',
            'cus_extra_income' => 'required|in:1,2',
            'cus_church' => 'required|string|max:255',
            'cus_other_church' => 'nullable|string|max:255',
            'cus_bcert' => 'required|in:1,0',
            'cus_born_state' => 'required|string|max:2',
            'cus_state_id' => 'required|in:1,0',
            'cus_state_no' => 'nullable|string|max:25',
            'cus_d_lice' => 'required|in:1,0',
            'cus_lice_no' => 'nullable|string|max:255',
            'cus_ss_card' => 'required|in:1,0',
            'cus_ssc_no' => 'nullable|string|max:255',
            'cus_insurace' => 'required|in:1,2',
            'cus_carrier' => 'nullable|string|max:255',
            'cus_mem_id' => 'nullable|string|max:255',
            'cus_grp_no' => 'nullable|string|max:255',
            'cus_more_friends' => 'required|in:1,2',
            'cus_counselor' => 'nullable|string|max:255',
            'cus_is_inv_rom' => 'required|in:1,0',
            'cus_is_mental_ill' => 'required|in:1,0',
            'cus_phy_dis' => 'nullable|string|max:255',
            'cus_comments' => 'nullable|string|max:255',
        ]);
        
        if ($validator->fails()) {
            dd($validator->errors());
            return response()->json($validator->errors(), 422);
        }
        
        DB::beginTransaction(); // Start the transaction

        try {
             // Create the property record
            $client = Client::create([
                'cus_name' => $request->cus_name ?? '',
                'email' => $request->cus_email ?? '',
                'cus_dob' => $request->cus_dob ?? '',
                'cus_ss' => $request->cus_ss ?? '',
                'martial_status' => $request->martial_status ?? '',
                'is_child' => $request->cus_is_child ?? '',
                'address' => $request->cus_address ?? '',
                'city' => $request->cus_city ?? '',
                'state' => $request->cus_state ?? '',
                'zipcode' => $request->cus_zip ?? '',
                'phone' => $request->cus_phone ?? '',
            ]);

            foreach($request->child_name as $child){
                ClientChild::create([
                    'gl_ID' => $client->id ?? '',
                    'child_name' => $child->child_name ?? '',
                    'child_age' => $child->child_age ?? '',
                ]);
            }
            
            ClientCriminalHistory::create([
                'gl_ID' => $client->id ?? '',
                'role' => $request->role ?? '',
                'date_of_con' => $request->cus_dfc ?? '',
                'conviction'=> $request->cus_con ?? '',
                'conq' => $request->cus_conq ?? '',
                'is_sex_off' => $request->cus_sex_off ?? '',
                'is_offend_minor' => $request->cus_is_offend_minor ?? '',
            ]);

            ClientCriminalHistory::create([
                'gl_ID' => $client->id ?? '',
                'role' => $request->role ?? '',
                'date_of_con' => $request->cus_dfc ?? '',
                'conviction'=> $request->cus_con ?? '',
                'conq' => $request->cus_conq ?? '',
                'is_sex_off' => $request->cus_sex_off ?? '',
                'is_offend_minor' => $request->cus_is_offend_minor ?? '',
            ]);

            ClientSurvey::create([
                'gl_ID'  => $client->id ?? '',
                'is_food' => $request->cus_food ?? '',
                'is_cloth' => $request->cus_cloth ?? '',
                'is_shelter' => $request->cus_shelter ?? '',
                'is_transport' => $request->cus_tra ?? '',
                'is_emp' => $request->cus_emp ?? '',
                'extra_incom' => $request->cus_extra_income ?? '',
                'church' => $request->cus_church ?? '',
                'custom_church' => $request->cus_other_church ?? '',
                'is_bcert' => $request->cus_bcert ?? '',
                'state_name' => $request->cus_born_state ?? '',
                'is_state_id' => $request->cus_state_id ?? '',
                'stateIDno' => $request->cus_state_no ?? '',
                'is_DL' => $request->cus_d_lice ?? '',
                'DlicenseNo' => $request->cus_lice_no ?? '',
                'is_ss_card' => $request->cus_ss_card ?? '',
                'ss_number' => $request->cus_ssc_no ?? '',
            ]);

            ClientsHealthIns::create([
                'gl_ID' => $client->id ?? '',
                'is_health'=> $request->cus_insurace ?? '',
                'carrier'=> $request->cus_carrier ?? '',
                'mem_id'=> $request->cus_mem_id ?? '',
                'grp_no'=> $request->cus_grp_no ?? '',
            ]);
            ClientInfo::create([
                'gl_ID' => $client->id ?? '',
                'more_friends'=> $request->cus_more_friends,
                'counselor'=> $request->cus_counselor,
                'is_inv_rom'=> $request->cus_is_inv_rom,
                'is_mental_ill'=> $request->cus_is_mental_ill,
                'phy_dis'=> $request->cus_phy_dis,
                'comments'=> $request->cus_comments,
            ]);
            
            DB::commit(); // Commit the transaction if everything works
            return redirect()->route('properties.index')->with('success', 'Property updated successfully.');
        } catch (\Exception $e) {

            DB::rollBack(); // Rollback if any operation fails
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the property. Please try again.']);
        }
        // Redirect or return a response
        return redirect()->route('clients.index')->with('success', 'Property created successfully!');
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
}
