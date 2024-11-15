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
use App\Models\Membership;
use App\Models\PurchasePlan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

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
            if($request->front){
                $validator->addRules([
                    'membership_id' => 'required',
                    'stripeToken' => 'required',
                    'last4' => 'required',
                    'exp_month' => 'required',
                    'exp_year' => 'required',
                ]);
            }

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
            
            if($request->front){
                PurchasePlan::create([
                    'user_id'=> $user->id,
                    'membership_id' => $request->membership_id,
                    'purchase_date' => now(),
                    'stripeToken' => $request->stripeToken,
                    'last4' => $request->last4,
                    'exp_month' => $request->exp_month,
                    'exp_year' => $request->exp_year,
                ]);
            }

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
        $membershipsMonthly = Membership::monthlyPlan()->get();
        $membershipsYearly = Membership::yearlyPlan()->get();
        return view('site.provider-registration',compact('membershipsMonthly','membershipsYearly'));
    }
    public function export(Request $request)
    {
        // Fetch data dynamically based on request filters
        $query = DB::table('properties')
            ->select('id', 'property_name', 'property_description', 'property_address', 'city', 'state', 'zipcode','created_at');
    
        // Apply filters (if passed in the request)
        if ($request->has('start_date')) {
            $query->where('created_at', '>=', $request->start_date);
        }
    
        if ($request->has('end_date')) {
            $query->where('created_at', '<=', $request->end_date);
        }
    
        // Get the filtered data
        $properties = $query->get();
    
        // Check if there are any users to export
        if ($properties->isEmpty()) {
            return response()->json(['message' => 'No users found for the given criteria.'], 404);
        }
    
        // Prepare CSV headers
        $csvData = "ID,User Type,First Name,Last Name,Email,Billing Address,City,State,Zip,Phone,Promo Opt Out,Created At\n";
    
        // Loop through the users and append data to CSV
        foreach ($properties as $property) {
            // Format the creation date
            $createdAt = Carbon::parse($property->created_at)->format('M d, Y g:i A'); // Format as 'Sep 30, 2024 3:45 PM'
            
            // Determine promotion option
            // $promotionOption = $user->promotion_opt == '1' ? 'Yes' : 'No';
            
            // Escape potentially harmful characters for CSV injection
            // $firstname = str_replace(["=", "+", "-", "@"], '', $user->firstname);
            // $lastname = str_replace(["=", "+", "-", "@"], '', $user->lastname);
            // $email = str_replace(["=", "+", "-", "@"], '', $user->email);
    
            // Append data to CSV
            $csvData .= "{$property->id},"
                . "{$property->property_name},"
                // . "{$firstname},"
                // . "{$lastname},"
                // . "{$email},"
                // . "{$user->billing_address},"
                // . "{$user->city},"
                // . "{$user->state},"
                // . "{$user->zip},"
                // . "{$user->phone},"
                // . "{$promotionOption},"
                . "{$createdAt}\n";
        }
    
        // Set the filename with a timestamp
        $fileName = 'users_export_' . now()->format('Y_m_d_H_i_s') . '.csv';
    
        // Return the CSV response with proper headers
        return Response::make($csvData, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ]);
    }
}
