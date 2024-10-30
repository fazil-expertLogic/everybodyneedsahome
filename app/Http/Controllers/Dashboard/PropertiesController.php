<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use App\Helpers\Helper;
use App\Models\User;
use App\Models\Property;
use App\Models\Category;

class PropertiesController extends Controller
{
  
    public function index(Request $request)
    {
        $allow_show = Helper::check_rights(2)->is_show;
        $allow_create = Helper::check_rights(2)->is_create;
        $allow_edit = Helper::check_rights(2)->is_edit;
        $allow_delete = Helper::check_rights(2)->is_delete;
        
        // Get the search parameters from the request
        $query = Property::query();
        
        if ($request->filled('property_type')) {
            $query->where('property_type', 'like', '%' . $request->property_type . '%');
        }
        
        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }
        
        if ($request->filled('state')) {
            $query->where('state', 'like', '%' . $request->state . '%');
        }
        
        if ($request->filled('zipcode')) {
            $query->where('zipcode', 'like', '%' . $request->zipcode . '%');
        }
    
        if ($request->filled('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('property_name', 'like', '%' . $request->search . '%')
                         ->orWhere('property_address', 'like', '%' . $request->search . '%');
            });
        }
    
        // Pagination
        $properties = $query->paginate(10);
    
        // Return the view with properties
        return view('livewire.properties.index', compact('properties','allow_show','allow_create','allow_edit','allow_delete'));
    }
    
    public function add()
    {
        $categories = Category::get();
        return view('livewire.properties.add',compact('categories'));
    }

    public function store(Request $request)
    {
        
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'property_name' => 'required|string|max:255',
            'property_description' => 'required|string',
            'property_address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zipcode' => 'required|string|max:20',
            'property_management_address' => 'required|string|max:255',
            'property_management_city' => 'required|string|max:100',
            'property_management_state' => 'required|string|max:100',
            'property_management_zipcode' => 'nullable|string|max:20', // Changed to nullable
            'property_type' => 'required|string|max:50',
            'number_of_beds' => 'nullable|integer',
            'rent_bed' => 'nullable|numeric',
            'bed_deposit' => 'nullable|numeric',
            'bed_fee' => 'nullable|numeric', // Changed to nullable
            'number_of_bedrooms' => 'nullable|integer',
            'stay_one_bedroom' => 'nullable|numeric',
            'bedroom_deposit' => 'nullable|numeric',
            'bedroom_fee' => 'nullable|numeric',
            'number_of_bedrooms_house' => 'nullable|integer',
            'number_of_bath_house' => 'nullable|integer',
            'rent_unit' => 'nullable|numeric',
            'unit_deposit' => 'nullable|numeric',
            'unit_fee' => 'nullable|numeric',
            'is_property_occupied' => 'required|boolean',
            'utilities_inscluded' => 'nullable|boolean',
            'main_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'more_pictures.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        DB::beginTransaction(); // Start the transaction

        try {
            // Handle image uploads

            if ($request->hasFile('main_picture')) {
                $mainPicture = $request->file('main_picture');
                $mainPicturePath = $mainPicture->store('property_images', 'public'); // Save in storage/app/public/property_images
            }

            // Handle more pictures upload
            $morePictures = [];
            if ($request->hasFile('more_picture')) {
                foreach ($request->file('more_picture') as $picture) {
                    $morePictures[] = $picture->store('property_images', 'public');
                }
            }

            // Create the property record
            Property::create([
                'property_name' => $request->property_name,
                'property_description' => $request->property_description,
                'property_address' => $request->property_address,
                'city' => $request->city,
                'state' => $request->state,
                'zipcode' => $request->zipcode,
                'property_management_address' => $request->property_management_address,
                'property_management_city' => $request->property_management_city,
                'property_management_state' => $request->property_management_state,
                'property_management_zipcode' => $request->property_management_zipcode,
                'property_type' => $request->property_type,
                'number_of_beds' => $request->number_of_beds,
                'rent_bed' => $request->rent_bed,
                'bed_deposit' => $request->bed_deposit,
                'bed_fee' => $request->bed_fee,
                'number_of_bedrooms' => $request->number_of_bedrooms,
                'stay_one_bedroom' => $request->stay_one_bedroom,
                'bedroom_deposit' => $request->bedroom_deposit,
                'bedroom_fee' => $request->bedroom_fee,
                'number_of_bedrooms_house' => $request->number_of_bedrooms_house,
                'number_of_bath_house' => $request->number_of_bath_house,
                'rent_unit' => $request->rent_unit,
                'unit_deposit' => $request->unit_deposit,
                'unit_fee' => $request->unit_fee,
                'is_property_occupied' => $request->is_property_occupied,
                'utilities_inscluded' => $request->utilities_inscluded,
                'status' => 1,
                'is_feature' => $request->is_feature ?? 0,
                'is_new' => $request->is_new ?? 0,
                'category_id'=>$request->category_id,
                'created_by' => Auth::user()->id,
                'main_picture' => $mainPicturePath,
                'more_pictures' => json_encode($morePictures), // Store as JSON if necessary
            ]);
            DB::commit(); // Commit the transaction if everything works

            return redirect()->route('properties.index')->with('success', 'Property updated successfully.');
        } catch (\Exception $e) {

            DB::rollBack(); // Rollback if any operation fails
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the property. Please try again.']);
        }
        // Redirect or return a response
        return redirect()->route('properties.index')->with('success', 'Property created successfully!');
    }

    public function show($id)
    {
        $categories = Category::get();
        $property = Property::findOrFail($id); // Fetch property by ID
        return view('livewire.properties.show', compact('property','categories')); // Return edit view
    }

    public function edit($id)
    {
        $categories = Category::get();
        $property = Property::findOrFail($id); // Fetch property by ID
        return view('livewire.properties.edit', compact('property','categories')); // Return edit view
    }
    public function destroy($id)
    {
        $property = Property::findOrFail($id); // Fetch property by ID
        $property->status = 0; // Delete property
        $property->save();
        return redirect()->route('properties.index')->with('success', 'Property deleted successfully.');
    }

    public function update(Request $request)
    {

        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'property_name' => 'required|string|max:255',
            'property_description' => 'required|string',
            'property_address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zipcode' => 'required|string|max:20',
            'property_management_address' => 'required|string|max:255',
            'property_management_city' => 'required|string|max:100',
            'property_management_state' => 'required|string|max:100',
            'property_management_zipcode' => 'nullable|string|max:20', // Changed to nullable
            'property_type' => 'required|string|max:50',
            'number_of_beds' => 'nullable|integer',
            'rent_bed' => 'nullable|numeric',
            'bed_deposit' => 'nullable|numeric',
            'bed_fee' => 'nullable|numeric|min:0|max:999999999999.99',
            'number_of_bedrooms' => 'nullable|integer',
            'stay_one_bedroom' => 'nullable|numeric',
            'bedroom_deposit' => 'nullable|numeric',
            'bedroom_fee' => 'nullable|numeric',
            'number_of_bedrooms_house' => 'nullable|integer',
            'number_of_bath_house' => 'nullable|integer',
            'rent_unit' => 'nullable|numeric',
            'unit_deposit' => 'nullable|numeric',
            'unit_fee' => 'nullable|numeric',
            'is_property_occupied' => 'required|boolean',
            'utilities_inscluded' => 'nullable|boolean',
            'main_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'more_pictures.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        DB::beginTransaction(); // Start the transaction
        try {
            // Create the property record
            $property = Property::findOrFail($request->id);

            if ($request->hasFile('main_picture')) {
                $mainPicture = $request->file('main_picture');
                $mainPicturePath = $mainPicture->store('property_images', 'public'); // Save in storage/app/public/property_images
            } else {
                $mainPicturePath = $property->main_picture;
            }

            // Handle more pictures upload
            $morePictures = [];
            if ($request->hasFile('more_picture')) {
                foreach ($request->file('more_picture') as $picture) {
                    $morePictures[] = $picture->store('property_images', 'public');
                }
            } else {
                $morePictures = $property->more_pictures;
            }

            $property->update([
                'property_name' => $request->property_name,
                'property_description' => $request->property_description,
                'property_address' => $request->property_address,
                'city' => $request->city,
                'state' => $request->state,
                'zipcode' => $request->zipcode,
                'property_management_address' => $request->property_management_address,
                'property_management_city' => $request->property_management_city,
                'property_management_state' => $request->property_management_state,
                'property_management_zipcode' => $request->property_management_zipcode,
                'property_type' => $request->property_type,
                'number_of_beds' => $request->number_of_beds,
                'rent_bed' => $request->rent_bed,
                'bed_deposit' => $request->bed_deposit,
                'bed_fee' => $request->bed_fee,
                'number_of_bedrooms' => $request->number_of_bedrooms,
                'stay_one_bedroom' => $request->stay_one_bedroom,
                'bedroom_deposit' => $request->bedroom_deposit,
                'bedroom_fee' => $request->bedroom_fee,
                'number_of_bedrooms_house' => $request->number_of_bedrooms_house,
                'number_of_bath_house' => $request->number_of_bath_house,
                'rent_unit' => $request->rent_unit,
                'unit_deposit' => $request->unit_deposit,
                'unit_fee' => $request->unit_fee,
                'is_property_occupied' => $request->is_property_occupied,
                'utilities_inscluded' => $request->utilities_inscluded,
                'status' => 1,
                'is_feature' => $request->is_feature ?? 0,
                'is_new' => $request->is_new ?? 0,
                'category_id'=>$request->category_id,
                'created_by' => Auth::user()->id,
                'main_picture' => $mainPicturePath,
                'more_pictures' => json_encode($morePictures), // Store as JSON if necessary
            ]);
            DB::commit(); // Commit the transaction if everything works
        
            return redirect()->route('properties.index')->with('success', 'Property updated successfully.');
        } catch (\Exception $e) {

            DB::rollBack(); // Rollback if any operation fails
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the property. Please try again.']);
        }
        // Redirect or return a response
        return redirect()->route('properties.index')->with('success', 'Property created successfully!');
    }
}
