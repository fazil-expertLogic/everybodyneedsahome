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

    public function pricing() {
        $memberships=Membership::monthlyPlan()->get();
        return view('site.pricing', compact('memberships'));

    }
}