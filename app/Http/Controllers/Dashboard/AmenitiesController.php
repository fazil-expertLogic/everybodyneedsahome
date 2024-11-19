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
        $query = DB::table('amenities')
            ->select('id', 'name', 'icon', 'status','created_at');

        if ($request->has('start_date')) {
            $query->where('created_at', '>=', $request->start_date);
        }
    
        if ($request->has('end_date')) {
            $query->where('created_at', '<=', $request->end_date);
        }

        $data = $query->get();

        if ($data->isEmpty()) {
            return response()->json(['message' => 'No users found for the given criteria.'], 404);
        }
        $csvData = "ID,Amenity Name,Amenity Icon,Amenity Status,Created At\n";
        foreach ($data as $value) {
    
            $createdAt = Carbon::parse($value->created_at)->format('M d, Y g:i A'); // Format as 'Sep 30, 2024 3:45 PM'
            
            if($value->status) 
                $status = 'Active';
            else
                $status= 'In Active';

                $csvData .= '"' . implode('","', [
                    $value->id,
                    $this->sanitizeForCsv($value->name),
                    $this->sanitizeForCsv($value->icon),
                    $status,
                    $createdAt
                ]) . "\"\n";
        }
    
        // Set the filename with a timestamp
        $fileName = 'Amenity_export_' . now()->format('Y_m_d_H_i_s') . '.csv';
    
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
                    $exists = Amenity::where('name', $data['Amenity Name'] ?? null)
                        ->where('icon', $data['Amenity Icon'] ?? null)
                        ->exists();
                    
                    if ($exists) {
                        continue; // Skip this row if a duplicate record exists
                    }         
                    if($data['Amenity Status'] == 'Active'){
                        $status = 1;
                    }else{
                        $status = 0;
                    }

                    // Map CSV data to database fields
                    $amenity = [
                        'name' => $data['Amenity Name'] ?? null,
                        'icon' => $data['Amenity Icon'] ?? null,
                        'staus' => $status
                    ];    
                    // Save the property
                    Amenity::create($amenity);
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
