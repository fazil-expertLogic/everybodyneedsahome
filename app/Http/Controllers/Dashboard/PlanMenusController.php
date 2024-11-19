<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\PlanMenu;
use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

class PlanMenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allow_show = Helper::check_rights(21)->is_show;
        $allow_create = Helper::check_rights(21)->is_create;
        $allow_edit = Helper::check_rights(21)->is_edit;
        $allow_delete = Helper::check_rights(21)->is_delete;
    
        $query = PlanMenu::query();
                
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('icon', 'like', '%' . $request->search . '%');
            });
        }

        $plan_menus = $query->active()->paginate(10);

        return view('livewire.plan_menus.index', compact('plan_menus','allow_show','allow_create','allow_edit','allow_delete'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('livewire.plan_menus.add');
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
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            DB::beginTransaction();
            PlanMenu::create([
                'name' =>  $request->name,
            ]);
            DB::commit();
            return redirect()->route('plan_menus.index')->with('success', 'menu create successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the menu. Please try again.']);
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
        $plan_menu = PlanMenu::findOrFail($id);
        return view('livewire.plan_menus.show', compact('plan_menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan_menu = PlanMenu::findOrFail($id);
        return view('livewire.plan_menus.edit', compact('plan_menu'));
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
                'route' => 'required|string|max:255',
                'icon' => 'required|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            DB::beginTransaction();
            $plan_menu = PlanMenu::findOrFail($id);
            $plan_menu->update([
                'name' =>  $request->name,
            ]);
            DB::commit();
            return redirect()->route('plan_menus.index')->with('success', 'menu create successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the menu. Please try again.']);
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
        $plan_menu = PlanMenu::findOrFail($id);
        $plan_menu->softDeleteRelations();
        return redirect()->route('plan_menus.index')->with('success', 'user have been soft deleted successfully');
    }

    public function export(Request $request)
    {
        // Fetch data dynamically based on request filters
        $query = DB::table('plan_menus')
            ->select('id', 'name','created_at');
    
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
            return response()->json(['message' => 'No users found for the given criteria.'], 404);
        }
    
        // Prepare CSV headers
        $csvData = "ID,Plan Menu,Created At\n";
    
        // Loop through the users and append data to CSV
        foreach ($data as $value) {
            // Format the creation date
            $createdAt = Carbon::parse($value->created_at)->format('M d, Y g:i A'); // Format as 'Sep 30, 2024 3:45 PM'
    
            // Append data to CSV
            $csvData .= '"' . implode('","', [
                $this->sanitizeForCsv($value->id),
                $this->sanitizeForCsv($value->name),
                $createdAt
            ]) . "\"\n";
        }
    
        // Set the filename with a timestamp
        $fileName = 'Plan_Menus_export_' . now()->format('Y_m_d_H_i_s') . '.csv';
    
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
                    $exists = PlanMenu::where('name', $data['Plan Menu'] ?? null)
                        ->exists();
                    
                    if ($exists) {
                        continue; // Skip this row if a duplicate record exists
                    }         

                    // Map CSV data to database fields
                    $plan_menu = [
                        'name' => $data['Plan Menu'] ?? null,
                        'staus' => 1
                    ];    
                    // Save the property
                    PlanMenu::create($plan_menu);
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
