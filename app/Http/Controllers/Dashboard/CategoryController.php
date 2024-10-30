<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Helper;

class CategoryController extends Controller
{
    // Function to display the list of categories with search, sorting, and pagination
    public function index(Request $request)
    {
        $allow_show = Helper::check_rights(10)->is_show;
        $allow_create = Helper::check_rights(10)->is_create;
        $allow_edit = Helper::check_rights(10)->is_edit;
        $allow_delete = Helper::check_rights(10)->is_delete;

        // Get the search query from the request, if any
        $search = $request->input('search', '');

        // Get the sort direction from the request, default to 'asc'
        $sortDirection = $request->input('sortDirection', 'asc');

        // Fetch categories based on search and sort direction
        $categories = Category::where('category_name', 'like', '%' . $search . '%')
            ->orderBy('created_at', $sortDirection)
            ->paginate(10); // You can adjust the number 10 for pagination as needed

        // Count the total number of categories
        $totalCategories = Category::count();

        // Return the view with categories data
        return view('livewire.categories.index', compact('allow_show','allow_create','allow_edit','allow_delete','categories','totalCategories','search','sortDirection'));
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('livewire.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        DB::beginTransaction(); // Start the transaction

        try {

             // Create the property record
            $category = Category::findOrFail($id);
            $category->update([
                'category_name' => $request->category_name ?? '',
            ]);
            DB::commit(); // Commit the transaction if everything works
            return redirect()->route('categories.index')->with('success', 'Category updated successfully.');

        } catch (\Exception $e) {

            DB::rollBack(); // Rollback if any operation fails
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the clients. Please try again.']);
        }
    }


    // Function to delete a category by its ID
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
        }

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }

    // Function to handle sorting toggle
    public function sort(Request $request)
    {
        // Toggle sorting direction
        $sortDirection = $request->input('sortDirection', 'asc') == 'asc' ? 'desc' : 'asc';

        return redirect()->route('categories.index', ['sortDirection' => $sortDirection]);
    }
}
