<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Provider;
use App\Helpers\Helper;
use App\Models\User;

class ProvidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allow_show = Helper::check_rights(4)->is_show;
        $allow_create = Helper::check_rights(4)->is_create;
        $allow_edit = Helper::check_rights(4)->is_edit;
        $allow_delete = Helper::check_rights(4)->is_delete;

        $query = Provider::query();
        
        if ($request->filled('provider_name')) {
            $query->where('provider_name', 'like', '%' . $request->provider_name . '%');
        }
        
        if ($request->filled('provider_email')) {
            $query->where('email', 'like', '%' . $request->provider_email . '%');
        }
        
        if ($request->filled('state')) {
            $query->where('state', 'like', '%' . $request->state . '%');
        }
        
        if ($request->filled('provider_company_name')) {
            $query->where('comany_name', 'like', '%' . $request->provider_company_name . '%');
        }
    
        if ($request->filled('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('provider_name', 'like', '%' . $request->search . '%')
                         ->orWhere('comany_name', 'like', '%' . $request->search . '%');
            });
        }
    
        // Pagination
        $providers = $query->active()->paginate(10);
        return view('livewire.provider.index', compact('providers','allow_show','allow_create','allow_edit','allow_delete'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('livewire.provider.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
        try {
             // Validate the incoming request
            $validator = Validator::make($request->all(), [
                'provider_name' => 'required|string|max:255',
                'comany_name' => 'required|string',
                'type' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:100',
                'state' => 'required|string|max:100',
                'zipcode' => 'required|string|max:20',
                'phone' => 'required|string|max:255',
                'email' => 'required|unique:users|string|max:100',
                'website' => 'required|string|max:100',
                'area_served' => 'required|string|max:20',
                'custom_area_served' => 'nullable|string|max:255',
                'pass' => 'required|string|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            DB::beginTransaction();
            $mainPicturePath = '';
            if ($request->hasFile('main_picture')) {
                $mainPicture = $request->file('main_picture');
                $mainPicturePath = $mainPicture->store('provider', 'public');
            }
            $user = User::create([
                'name' => $request->provider_name,
                'email' => $request->email,
                'password' => Hash::make($request->pass), 
                'role_id' => "4",
            ]);
            Provider::create([
                'provider_name' =>  $request->provider_name,
                'comany_name' =>  $request->comany_name,
                'Type' =>  $request->type,
                'address' =>  $request->address,
                'city' =>  $request->city,
                'state' =>  $request->state,
                'zipcode' =>  $request->zipcode,
                'phone' =>  $request->phone,
                'email' =>  $request->email,
                'website' =>  $request->website,
                'area_served' =>  $request->area_served,
                'custom_area_served' =>  $request->custom_area_served,
                'user_id' => $user->id,
                'profile_image' => $mainPicturePath ?? '',
            ]);

            DB::commit();
            return redirect()->route('providers.index')->with('success', 'Providers create successfully.');
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
        $provider = Provider::findOrFail($id); // Fetch property by ID
        return view('livewire.provider.show', compact('provider')); // Return edit view
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $provider = Provider::findOrFail($id); // Fetch property by ID
        return view('livewire.provider.edit', compact('provider')); // Return edit view
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
            // Validate the incoming request
            $validator = Validator::make($request->all(), [
                'provider_name' => 'required|string|max:255',
                'comany_name' => 'required|string',
                'type' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:100',
                'state' => 'required|string|max:100',
                'zipcode' => 'required|string|max:20',
                'phone' => 'required|string|max:255',
                'email' => 'required|string|max:100',
                'website' => 'required|string|max:100',
                'area_served' => 'required|string|max:20',
                'custom_area_served' => 'nullable|string|max:255',                
                'pass' => 'nullable|string|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            DB::beginTransaction();
            
            if ($request->hasFile('main_picture')) {
                $mainPicture = $request->file('main_picture');
                $mainPicturePath = $mainPicture->store('provider', 'public');
            }

            $provider = Provider::findOrFail($id);
            $user = User::where('id',$provider->user_id)->first();
            $user->update([
                'name' => $request->provider_name,
                'email' => $request->email,
                'password' => $request->pass ? Hash::make($request->pass) : $user->password,
                'role_id' => "4",
            ]);

            $provider->update([
               'provider_name' =>  $request->provider_name,
               'comany_name' =>  $request->comany_name,
               'Type' =>  $request->type,
               'address' =>  $request->address,
               'city' =>  $request->city,
               'state' =>  $request->state,
               'zipcode' =>  $request->zipcode,
               'phone' =>  $request->phone,
               'email' =>  $request->email,
               'website' =>  $request->website,
               'area_served' =>  $request->area_served,
               'custom_area_served' =>  $request->custom_area_served,
               'profile_image' => $mainPicturePath ?? $provider->profile_image,
            ]);  

           DB::commit();
           return redirect()->route('providers.index')->with('success', 'Providers create successfully.');
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
        $provider = Provider::findOrFail($id);
        $provider->softDeleteRelations();
        return redirect()->route('providers.index')->with('success', 'provider have been soft deleted successfully');
    }
    
    public function provider_registration_website(){
        return view('site.provider-registration');
    }
}
