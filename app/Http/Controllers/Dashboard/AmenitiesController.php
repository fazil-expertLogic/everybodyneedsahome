<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Amenity;
use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

class AmenitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allow_show = Helper::check_rights(15)->is_show;
        $allow_create = Helper::check_rights(15)->is_create;
        $allow_edit = Helper::check_rights(15)->is_edit;
        $allow_delete = Helper::check_rights(15)->is_delete;

        $query = Amenity::query();
                
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('icon')) {
            $query->where('icon', 'like', '%' . $request->icon . '%');
        }

        if ($request->filled('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('icon', 'like', '%' . $request->search . '%');
            });
        }

        $amenities = $query->active()->paginate(10);

        return view('livewire.amenities.index', compact('amenities','allow_show','allow_create','allow_edit','allow_delete'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('livewire.amenities.add');
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
                'name' => 'required|string|max:255',
                'icon' => 'required|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            DB::beginTransaction();
            Amenity::create([
                'name' =>  $request->name,
                'icon' =>  $request->icon,
            ]);
            DB::commit();
            return redirect()->route('amenities.index')->with('success', 'amenity create successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the amenity. Please try again.']);
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
        $amenity = Amenity::findOrFail($id);
        return view('livewire.amenities.show', compact('amenity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $amenity = Amenity::findOrFail($id);
        return view('livewire.amenities.edit', compact('amenity'));
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
                'name' => 'required|string|max:255',
                'icon' => 'required|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            DB::beginTransaction();
            $amenity = Amenity::findOrFail($id);
            $amenity->update([
                'name' =>  $request->name,
                'icon' =>  $request->icon,
            ]);
            DB::commit();
            return redirect()->route('amenities.index')->with('success', 'amenity create successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the amenity. Please try again.']);
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
        $amenity = Amenity::findOrFail($id);
        $amenity->softDeleteRelations();
        return redirect()->route('amenities.index')->with('success', 'user have been soft deleted successfully');
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
