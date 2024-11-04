<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Property;
use App\Models\Client;
use App\Models\Membership;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function buyPropertyGrid(Request $request)
    {
        $properties = Property::with('category')->active()->get();
        return view('site.buy-property-grid', compact('properties'));
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function pricing()
    {
        $membershipsMonthly = Membership::monthlyPlan()->get();
        $membershipsYearly = Membership::yearlyPlan()->get();
        return view('site.pricing', compact('membershipsMonthly', 'membershipsYearly'));
    }



    public function propertyList()
    {
        $properties = Property::active()->get();
        $categories = Category::all();

        return view('site.property-list', compact('properties', 'categories'));
    }

    public function home()
    {
        $properties = Property::feature()->take(3)->get();

        return view('site.index', compact('properties'));
    }

    public function searchProperties(Request $request)
    {
        $query = Property::query();

        if ($request->keywords) {
            $query->where('property_name', 'LIKE', '%' . $request->keywords . '%');
        }
        if ($request->state && $request->state !== 'Select States') {
            $query->where('state', $request->state);
        }
        if ($request->bedrooms && $request->bedrooms !== 'No of Bedrooms') {
            $query->where('number_of_bedrooms', $request->bedrooms);
        }
        if ($request->bathrooms && $request->bathrooms !== 'No of Bathrooms') {
            $query->where('number_of_bath_house', $request->bathrooms);
        }
        if ($request->minSqft) {
            $query->where('sqft', '>=', $request->minSqft);
        }

        $properties = $query->with('category')->active()->get();

        return response()->json(['properties' => $properties]);
    }
}
