<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    // Function to display the list of categories with search, sorting, and pagination
    public function index(Request $request)
    {
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
        return view('livewire.categories.index', [
            'categories' => $categories,
            'totalCategories' => $totalCategories,
            'search' => $search,
            'sortDirection' => $sortDirection,
        ]);
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
