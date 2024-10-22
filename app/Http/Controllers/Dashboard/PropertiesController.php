<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Property;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PropertiesController extends Controller
{
    // Show login form

    public function index()
    {
        $properties = Property::get();
        return view('livewire.properties.listingProperties',compact('properties'));
    }
    public function addProperties()
    {
        return view('livewire.properties.addProperty');
    }
    public function postPoperty(Request $request)
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
            'rent_bed' => 'required|numeric',
            'bed_deposit' => 'required|numeric',
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
            'main_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'more_pictures.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Handle image uploads
        $mainPicturePath = $request->file('main_picture')->store('properties/main', 'public');
        $morePicturesPaths = [];

        if ($request->hasFile('more_pictures')) {
            foreach ($request->file('more_pictures') as $file) {
                $morePicturesPaths[] = $file->store('properties/more', 'public');
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
            'main_picture' => $mainPicturePath,
            'more_pictures' => json_encode($morePicturesPaths), // Store as JSON if necessary
        ]);
        // Redirect or return a response
        return redirect()->route('properties.index')->with('success', 'Property created successfully!');
    }
    
}
