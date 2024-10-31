<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Helper;
use App\Models\User;
use App\Models\Client;
use App\Models\ClientInfo;
use App\Models\ClientChild;
use App\Models\ClientSurvey;
use App\Models\ClientsHealthIns;
use App\Models\ClientCriminalHistory;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allow_show = Helper::check_rights(3)->is_show;
        $allow_create = Helper::check_rights(3)->is_create;
        $allow_edit = Helper::check_rights(3)->is_edit;
        $allow_delete = Helper::check_rights(3)->is_delete;

        // $clients = Client::active()->paginate(10);

        $query = Client::query();
                
        if ($request->filled('cus_name')) {
            $query->where('cus_name', 'like', '%' . $request->cus_name . '%');
        }

        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        if ($request->filled('state')) {
            $query->where('state', 'like', '%' . $request->state . '%');
        }

        if ($request->filled('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('cus_name', 'like', '%' . $request->search . '%')
                        ->orWhere('address', 'like', '%' . $request->search . '%');
            });
        }

        $clients = $query->active()->paginate(10);

        return view('livewire.client.index', compact('clients','allow_show','allow_create','allow_edit','allow_delete'));
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
            'cus_ss' => 'required|string',
            'martial_status' => 'required',
            'cus_is_child' => 'required',
            // 'child_name' => 'array',
            // 'child_name.*' => 'string|max:255',
            // 'child_age' => 'array',
            // 'child_age.*' => 'integer|min:0|max:18',
            'cus_address' => 'required|string|max:255',
            'cus_city' => 'required|string|max:255',
            'cus_state' => 'required|string|max:255',
            'cus_zip' => 'required|string|max:255',
            'cus_phone' => 'required|string|max:255',
            'role' => 'required',
            'cus_dfc' => 'required|date',
            'cus_con' => 'required|string|max:255',
            'cus_conq' => 'required',
            'cus_sex_off' => 'required',
            'cus_is_offend_minor' => 'required',
            'cus_food' => 'required',
            'cus_cloth' => 'required',
            'cus_shelter' => 'required',
            'cus_tra' => 'required',
            'cus_emp' => 'required',
            'cus_extra_income' => 'required',
            'cus_church' => 'required|string|max:255',
            'cus_other_church' => 'nullable|string|max:255',
            'cus_bcert' => 'required',
            'cus_born_state' => 'nullable|string|max:255',
            'cus_state_id' => 'required',
            'cus_state_no' => 'nullable|string|max:255',
            'cus_d_lice' => 'required',
            'cus_lice_no' => 'nullable|string|max:255',
            'cus_ss_card' => 'required',
            'cus_ssc_no' => 'nullable|string|max:255',
            'cus_insurace' => 'required',
            'cus_carrier' => 'nullable|string|max:255',
            'cus_mem_id' => 'nullable|string|max:255',
            'cus_grp_no' => 'nullable|string|max:255',
            'cus_more_friends' => 'required',
            'cus_counselor' => 'nullable|string|max:255',
            'cus_is_inv_rom' => 'required',
            'cus_is_mental_ill' => 'required',
            'cus_phy_dis' => 'nullable|string|max:255',
            'cus_comments' => 'nullable|string|max:255',
            'pass' => 'required|string|min:8|confirmed',
        ]);
        
        if ($validator->fails()) {
            dd($validator->errors());
            return response()->json($validator->errors(), 422);
        }
        
        DB::beginTransaction(); // Start the transaction
        
        try {
            $mainPicturePath = '';
            if ($request->hasFile('main_picture')) {
                $mainPicture = $request->file('main_picture');
                $mainPicturePath = $mainPicture->store('client', 'public');
            }

            // Create the property record
            $user = User::create([
                'name' => $request->cus_name,
                'email' => $request->cus_email,
                'password' => Hash::make($request->pass), 
                'role_id' => "3",
            ]);

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
                'user_id' => $user->id,
                'profile_image' => $mainPicturePath ?? '',
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
            return redirect()->route('clients.index')->with('success', 'client updated successfully.');
        } catch (\Exception $e) {

            DB::rollBack(); // Rollback if any operation fails
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the client. Please try again.']);
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
        $client = Client::WithAllRelations()->findOrFail($id); // Fetch property by ID
        
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
        $client = Client::WithAllRelations()->findOrFail($id);
        return view('livewire.client.edit', compact('client'));
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
            'cus_ss' => 'required|string',
            'martial_status' => 'required|in:1,2,3', // Adjust options based on possible statuses
            'cus_is_child' => 'required|in:1,2',
            // 'child_name' => 'array',
            // 'child_name.*' => 'string|max:255',
            // 'child_age' => 'array',
            // 'child_age.*' => 'integer|min:0|max:18',
            'cus_address' => 'required|string|max:255',
            'cus_city' => 'required|string|max:255',
            'cus_state' => 'required|string|max:255',
            'cus_zip' => 'required|string|max:255',
            'cus_phone' => 'required|string|max:255',
            'role' => 'required|in:1,2,3', // Adjust options based on possible roles
            'cus_dfc' => 'required|date',
            'cus_con' => 'required|string|max:255',
            'cus_conq' => 'required|in:1,2',
            'cus_sex_off' => 'required|in:1,2',
            'cus_is_offend_minor' => 'required|in:1,2',
            'cus_food' => 'required|in:1,2',
            'cus_cloth' => 'required|in:1,2',
            'cus_shelter' => 'required|in:1,2',
            'cus_tra' => 'required|in:1,2',
            'cus_emp' => 'required|in:1,2',
            'cus_extra_income' => 'required|in:1,2',
            'cus_church' => 'required|string|max:255',
            'cus_other_church' => 'nullable|string|max:255',
            'cus_bcert' => 'required|in:1,2',
            'cus_born_state' => 'nullable|string|max:255',
            'cus_state_id' => 'required|in:1,2',
            'cus_state_no' => 'nullable|string|max:255',
            'cus_d_lice' => 'required|in:1,2',
            'cus_lice_no' => 'nullable|string|max:255',
            'cus_ss_card' => 'required|in:1,2',
            'cus_ssc_no' => 'nullable|string|max:255',
            'cus_insurace' => 'required|in:1,2',
            'cus_carrier' => 'nullable|string|max:255',
            'cus_mem_id' => 'nullable|string|max:255',
            'cus_grp_no' => 'nullable|string|max:255',
            'cus_more_friends' => 'required|in:1,2',
            'cus_counselor' => 'nullable|string|max:255',
            'cus_is_inv_rom' => 'required|in:1,2',
            'cus_is_mental_ill' => 'required|in:1,2',
            'cus_phy_dis' => 'nullable|string|max:255',
            'cus_comments' => 'nullable|string|max:255',
            'pass' => 'nullable|string|min:8|confirmed',
        ]);
        
        if ($validator->fails()) {
            dd($validator->errors());
            return response()->json($validator->errors(), 422);
        }
        
        DB::beginTransaction(); // Start the transaction

        try {
          
            if ($request->hasFile('main_picture')) {
                $mainPicture = $request->file('main_picture');
                $mainPicturePath = $mainPicture->store('client', 'public');
            }
             // Create the property record
            $client = Client::findOrFail($id);
            $user = User::where('id',$client->user_id)->first();
            $user->update([
                'name' => $request->cus_name,
                'email' => $request->cus_email,
                'password' => $request->pass ? Hash::make($request->pass) : $user->password,
                'role_id' => "3",
            ]);
            $client->update([
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
                'user_id'=>$user->id,
                'profile_image' => $mainPicturePath ?? $client->profile_image,
            ]);

            ClientChild::where('gl_ID',$id)->delete();

            foreach($request->child_name as $c_key => $child){
                ClientChild::create([
                    'gl_ID' => $client->id ?? '',
                    'child_name' => $request->child_name[$c_key] ?? '',
                    'child_age' => $request->child_age[$c_key] ?? '',
                ]);
            }
            
            $client_criminal_history = ClientCriminalHistory::where('gl_ID',$id)->first();
            $client_criminal_history->update([
                'gl_ID' => $client->id ?? '',
                'role' => $request->role ?? '',
                'date_of_con' => $request->cus_dfc ?? '',
                'conviction'=> $request->cus_con ?? '',
                'conq' => $request->cus_conq ?? '',
                'is_sex_off' => $request->cus_sex_off ?? '',
                'is_offend_minor' => $request->cus_is_offend_minor ?? '',
            ]);
    
            $client_survey = ClientSurvey::where('gl_ID',$id)->first();
            $client_survey->update([
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


            $clients_health_ins = ClientsHealthIns::where('gl_ID',$id)->first();
            $clients_health_ins->update([
                'gl_ID' => $client->id ?? '',
                'is_health'=> $request->cus_insurace ?? '',
                'carrier'=> $request->cus_carrier ?? '',
                'mem_id'=> $request->cus_mem_id ?? '',
                'grp_no'=> $request->cus_grp_no ?? '',
            ]);

            $client_info = ClientInfo::where('gl_ID',$id)->first();
            $client_info->update([
                'gl_ID' => $client->id ?? '',
                'more_friends'=> $request->cus_more_friends,
                'counselor'=> $request->cus_counselor,
                'is_inv_rom'=> $request->cus_is_inv_rom,
                'is_mental_ill'=> $request->cus_is_mental_ill,
                'phy_dis'=> $request->cus_phy_dis,
                'comments'=> $request->cus_comments,
            ]);
            
            DB::commit(); // Commit the transaction if everything works
            return redirect()->route('clients.index')->with('success', 'clients updated successfully.');
        } catch (\Exception $e) {

            DB::rollBack(); // Rollback if any operation fails
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the clients. Please try again.']);
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
        $client = Client::findOrFail($id);
        $client->softDeleteRelations();
        return redirect()->route('clients.index')->with('success', 'Client and related records have been soft deleted successfully');
    }

    public function client_registration_website(){
        return view('site.client-registration');
    }
}
