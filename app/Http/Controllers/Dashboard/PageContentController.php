<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\PageContent;
use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
class PageContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allow_show = Helper::check_rights(19)->is_show;
        $allow_create = Helper::check_rights(19)->is_create;
        $allow_edit = Helper::check_rights(19)->is_edit;
        $allow_delete = Helper::check_rights(19)->is_delete;

        $query = PageContent::query();
                
        if ($request->filled('page_url')) {
            $query->where('page_url', 'like', '%' . $request->page_url . '%');
        }
        
        if ($request->filled('variable')) {
            $query->where('variable', 'like', '%' . $request->variable . '%');
        }

        if ($request->filled('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('page_url', 'like', '%' . $request->search . '%')
                ->orWhere('variable', 'like', '%' . $request->search . '%')
                ->orWhere('text', 'like', '%' . $request->search . '%');
            });
        }

        $pageContents = $query->paginate(10);

        return view('livewire.pageContents.index', compact('pageContents','allow_show','allow_create','allow_edit','allow_delete'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('livewire.pageContents.add');
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
                'page_url' => 'required|string|max:255',
                'variable' => 'required|string|max:255',
                'text' => 'required|string',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            DB::beginTransaction();
            PageContent::create([
                'page_url' =>  $request->page_url,
                'variable' => $request->variable,
                'text' => $request->text
            ]);
            DB::commit();
            return redirect()->route('pageContents.index')->with('success', 'Page Content create successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the Page Content. Please try again.']);
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
        $pageContent = PageContent::findOrFail($id);
        return view('livewire.pageContents.show', compact('pageContent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageContent = PageContent::findOrFail($id);
        return view('livewire.pageContents.edit', compact('pageContent'));
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
                'page_url' => 'required|string|max:255',
                'variable' => 'required|string|max:255',
                'text' => 'required|string',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            DB::beginTransaction();
            $pageContent = PageContent::findOrFail($id);
            $pageContent->update([
                'page_url' =>  $request->page_url,
                'variable' => $request->variable,
                'text' => $request->text
            ]);
            DB::commit();
            return redirect()->route('pageContents.index')->with('success', 'Page Content create successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the Page Content. Please try again.']);
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
        $pageContent = PageContent::findOrFail($id);
        $pageContent->softDeleteRelations();
        return redirect()->route('pageContents.index')->with('success', 'user have been soft deleted successfully');
    }

    public function export(Request $request)
    {
        // Fetch data dynamically based on request filters
        $query = DB::table('page_contents')
            ->select('id', 'page_url','variable','text','created_at');
    
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
        $csvData = "ID,Page Url,Variable,Text,Created At\n";
    
        // Loop through the users and append data to CSV
        foreach ($data as $value) {
            // Format the creation date
            $createdAt = Carbon::parse($value->created_at)->format('M d, Y g:i A'); // Format as 'Sep 30, 2024 3:45 PM'
    
            // Append data to CSV
            $csvData .= '"' . implode('","', [
                $this->sanitizeForCsv($value->id),
                $this->sanitizeForCsv($value->page_url),
                $this->sanitizeForCsv($value->variable),
                $this->sanitizeForCsv($value->text),
                $createdAt
            ]) . "\"\n";
        }
    
        // Set the filename with a timestamp
        $fileName = 'Page_Content_export_' . now()->format('Y_m_d_H_i_s') . '.csv';
    
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
}
