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
use App\Models\PropertyReview;

class PropertyReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allow_show = Helper::check_rights(2)->is_show;
        $allow_create = Helper::check_rights(2)->is_create;
        $allow_edit = Helper::check_rights(2)->is_edit;
        $allow_delete = Helper::check_rights(2)->is_delete;

        // Get the search parameters from the request
        $query = PropertyReview::query();

        if ($request->filled('reviewer_name')) {
            $query->where('reviewer_name', 'like', '%' . $request->reviewer_name . '%');
        }

        if ($request->filled('reviewer_email')) {
            $query->where('reviewer_email', 'like', '%' . $request->reviewer_email . '%');
        }

        if ($request->filled('comment')) {
            $query->where('comment', 'like', '%' . $request->comment . '%');
        }

        if ($request->filled('search')) {
            $query->where(function ($subquery) use ($request) {
                $subquery->where('reviewer_name', 'like', '%' . $request->search . '%')
                    ->orWhere('reviewer_email', 'like', '%' . $request->search . '%')
                    ->orWhere('comment', 'like', '%' . $request->search . '%');
            });
        }

        $propertyReviewes = $query->with('property')->paginate(10);
        
        return view('livewire.property_review.index', compact('propertyReviewes', 'allow_show', 'allow_create', 'allow_edit', 'allow_delete'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $property_review = PropertyReview::findOrFail($id);
        return view('livewire.property_review.show', compact('property_review'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $property_review = PropertyReview::findOrFail($id);
        return view('livewire.property_review.edit', compact('property_review'));
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
        $property = PropertyReview::findOrFail($id);
        $property->update([
            'approved' => $request->approved,
        ]);
        return redirect()->route('propertyReview.index')->with('success', 'Property Review updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
