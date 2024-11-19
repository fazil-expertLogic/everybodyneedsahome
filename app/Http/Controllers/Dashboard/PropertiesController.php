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
use App\Models\Amenity;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

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
            $query->where(function ($subquery) use ($request) {
                $subquery->where('property_name', 'like', '%' . $request->search . '%')
                    ->orWhere('property_address', 'like', '%' . $request->search . '%');
            });
        }

        // Pagination
        if(Auth::user()->role->name == 'Provider'){
            $properties = $query->active()->byUser()->paginate(10);
        }else{
            $properties = $query->active()->paginate(10);
        }

        // Return the view with properties
        return view('livewire.properties.index', compact('properties', 'allow_show', 'allow_create', 'allow_edit', 'allow_delete'));
    }

    public function add()
    {
        $categories = Category::get();
        $amenities = Amenity::active()->get();
        return view('livewire.properties.add', compact('categories','amenities'));
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
            // 'property_type' => 'required|string|max:50',
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
            dd($validator->errors());
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
            $data = [
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
                'category_id' => $request->category_id,
                'created_by' => Auth::user()->id,
                'main_picture' => $mainPicturePath,
                'more_pictures' => json_encode($morePictures), // Store as JSON if necessary
            ];
            
            // Conditionally add 'property_amenities' if it exists in the request
            if ($request->has('property_amenities')) {
                $data['property_amenities'] = json_encode($request->property_amenities);
            }
            // Now create the property with the assembled data
            Property::create($data);            
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
        return view('livewire.properties.show', compact('property', 'categories')); // Return edit view
    }

    public function edit($id)
    {
        $categories = Category::get();
        $property = Property::findOrFail($id); // Fetch property by ID
        $amenities = Amenity::active()->get();
        return view('livewire.properties.edit', compact('property', 'categories','amenities')); // Return edit view
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
            // 'property_type' => 'required|string|max:50',
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
            'main_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'more_pictures.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            dd($validator->errors());
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
                'category_id' => $request->category_id,
                'created_by' => Auth::user()->id,
                // 'main_picture' => $mainPicturePath,
                // 'more_pictures' => json_encode($morePictures),
            ]);
            if ($request->file('more_picture')) {
                $property->update([
                    'main_picture' => $mainPicturePath,
                ]);
            }
            if ($request->file('more_picture')) {
                $property->update([
                    'more_pictures' => json_encode($morePictures),
                ]);
            }

            if ($request->Has('property_amenities')) {
                $property->update([
                    'property_amenities' => json_encode($request->property_amenities),
                ]);
            }
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

    public function export(Request $request)
    {
        // Fetch data dynamically based on request filters
        $query = DB::table('properties')
            ->select('id','property_name' ,'property_description', 'property_address', 'city', 'state', 'zipcode', 'property_management_address', 'property_management_city', 'property_management_state', 'property_management_zipcode', 'property_type', 'number_of_beds', 'rent_bed', 'bed_deposit', 'bed_fee', 'number_of_bedrooms', 'stay_one_bedroom', 'bedroom_deposit', 'bedroom_fee', 'number_of_bedrooms_house', 'number_of_bath_house', 'rent_unit', 'unit_deposit', 'unit_fee', 'is_property_occupied', 'main_picture', 'more_pictures', 'is_feature', 'is_new', 'created_by', 'category_id', 'property_amenities', 'created_at');
    
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
            return response()->json(['message' => 'No properties found for the given criteria.'], 404);
        }
    
        // Prepare CSV headers
        $csvData = "ID,Property Name,Property Description,Property Address,City,State,Zipcode,Property Management Address,Property Management City,Property Management State,Property Management Zipcode,Property Type,Number Of Beds,Rent Bed,Bed Deposit,Bed Fee,Number Of Bedrooms,Stay One Bedroom,Bedroom Deposit,Bedroom Fee,Number Of Bedrooms House,Number Of Bath House,Rent Unit,Unit Deposit,Unit Fee,Is Property Occupied,Main Picture,More Pictures,Is Feature,Is New,Created By,Category Id,Property Amenities,Created At\n";
    
        // Loop through the users and append data to CSV
        foreach ($data as $value) {
            // Format the creation date
            $createdAt = \Carbon\Carbon::parse($value->created_at)->format('M d, Y g:i A'); // Format as 'Sep 30, 2024 3:45 PM'
    
            // Safely wrap each value in double quotes
            $csvData .= '"' . implode('","', [
                $value->id,
                $this->sanitizeForCsv($value->property_name),
                $this->sanitizeForCsv($value->property_description),
                $this->sanitizeForCsv($value->property_address),
                $this->sanitizeForCsv($value->city),
                $this->sanitizeForCsv($value->state),
                $this->sanitizeForCsv($value->zipcode),
                $this->sanitizeForCsv($value->property_management_address),
                $this->sanitizeForCsv($value->property_management_city),
                $this->sanitizeForCsv($value->property_management_state),
                $this->sanitizeForCsv($value->property_management_zipcode),
                $this->sanitizeForCsv($value->property_type),
                $value->number_of_beds,
                $value->rent_bed,
                $value->bed_deposit,
                $value->bed_fee,
                $value->number_of_bedrooms,
                $value->stay_one_bedroom,
                $value->bedroom_deposit,
                $value->bedroom_fee,
                $value->number_of_bedrooms_house,
                $value->number_of_bath_house,
                $value->rent_unit,
                $value->unit_deposit,
                $value->unit_fee,
                $value->is_property_occupied,
                $this->sanitizeForCsv($value->main_picture),
                $this->sanitizeForCsv($value->more_pictures),
                $value->is_feature,
                $value->is_new,
                $value->created_by,
                $value->category_id,
                $this->sanitizeForCsv($value->property_amenities),
                $createdAt
            ]) . "\"\n";
        }
    
        // Set the filename with a timestamp
        $fileName = 'Property_export_' . now()->format('Y_m_d_H_i_s') . '.csv';
    
        // Return the CSV response with proper headers
        return response($csvData, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ]);
    }
    
    // Helper function to sanitize values for CSV
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
                    $exists = Property::where('property_name', $data['Property Name'] ?? null)
                        ->where('property_address', $data['Property Address'] ?? null)
                        ->exists();

                    if ($exists) {
                        continue; // Skip this row if a duplicate record exists
                    }         
                    // Map CSV data to database fields
                    $property = [
                        'property_name' => $data['Property Name'] ?? null,
                        'property_description' => $data['Property Description'] ?? null,
                        'property_address' => $data['Property Address'] ?? null,
                        'city' => $data['City'] ?? null,
                        'state' => $data['State'] ?? null,
                        'zipcode' => $data['Zipcode'] ?? null,
                        'property_management_address' => $data['Property Management Address'] ?? null,
                        'property_management_city' => $data['Property Management City'] ?? null,
                        'property_management_state' => $data['Property Management State'] ?? null,
                        'property_management_zipcode' => $data['Property Management Zipcode'] ?? null,
                        'property_type' => $data['Property Type'] ?? null,
                        'number_of_beds' => $data['Number Of Beds'] ?? null,
                        'rent_bed' => $data['Rent Bed'] ?? null,
                        'bed_deposit' => $data['Bed Deposit'] ?? null,
                        'bed_fee' => $data['Bed Fee'] ?? null,
                        'number_of_bedrooms' => $data['Number Of Bedrooms'] ?? null,
                        'stay_one_bedroom' => $data['Stay One Bedroom'] ?? null,
                        'bedroom_deposit' => $data['Bedroom Deposit'] ?? null,
                        'bedroom_fee' => $data['Bedroom Fee'] ?? null,
                        'number_of_bedrooms_house' => $data['Number Of Bedrooms House'] ?? null,
                        'number_of_bath_house' => $data['Number Of Bath House'] ?? null,
                        'rent_unit' => $data['Rent Unit'] ?? null,
                        'unit_deposit' => $data['Unit Deposit'] ?? null,
                        'unit_fee' => $data['Unit Fee'] ?? null,
                        'is_property_occupied' => $data['Is Property Occupied'] ?? null,
                        'utilities_inscluded' => $data['Utilities Included'] ?? null,
                        'status' => 1,
                        'is_feature' => $data['Is Feature'] ?? 0,
                        'is_new' => $data['Is New'] ?? 0,
                        'category_id' => $data['Category Id'] ?? null,
                        'created_by' => Auth::user()->id,
                    ];
                    
                    // Add 'property_amenities' if it exists
                    if (!empty($data['Property Amenities'])) {
                        $property['property_amenities'] = is_array($data['Property Amenities'])
                            ? json_encode($data['Property Amenities'])
                            : $data['Property Amenities'];
                    }
                    // Save the property
                    Property::create($property);
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
