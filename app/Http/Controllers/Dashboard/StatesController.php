<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\State;
use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allow_show = Helper::check_rights(16)->is_show;
        $allow_create = Helper::check_rights(16)->is_create;
        $allow_edit = Helper::check_rights(16)->is_edit;
        $allow_delete = Helper::check_rights(16)->is_delete;

        $query = State::query();
                
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $states = $query->active()->paginate(10);

        return view('livewire.states.index', compact('states','allow_show','allow_create','allow_edit','allow_delete'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('livewire.states.add');
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
                'name' => 'required|string|max:255'
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            DB::beginTransaction();
            State::create([
                'name' =>  $request->name
            ]);
            DB::commit();
            return redirect()->route('states.index')->with('success', 'State create successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the State. Please try again.']);
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
        $state = State::findOrFail($id);
        return view('livewire.states.show', compact('state'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $state = State::findOrFail($id);
        return view('livewire.states.edit', compact('state'));
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
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            DB::beginTransaction();
            $state = State::findOrFail($id);
            $state->update([
                'name' =>  $request->name,
            ]);
            DB::commit();
            return redirect()->route('states.index')->with('success', 'State create successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the State. Please try again.']);
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
        $state = State::findOrFail($id);
        $state->softDeleteRelations();
        return redirect()->route('states.index')->with('success', 'user have been soft deleted successfully');
    }
    public function export(Request $request)
    {
        // Fetch data dynamically based on request filters
        $query = DB::table('states')
            ->select('id', 'name', 'status','created_at');
    
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
        $csvData = "ID,Name,Status,Created At\n";
    
        // Loop through the users and append data to CSV
        foreach ($data as $value) {
            // Format the creation date
            $createdAt = Carbon::parse($value->created_at)->format('M d, Y g:i A'); // Format as 'Sep 30, 2024 3:45 PM'
            
            // Determine promotion optionstates
    
            // Append data to CSV
            $csvData .= "{$value->id},"
                
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
