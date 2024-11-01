<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Property;
use App\Models\Client;

class FrontendController extends Controller
{
    public function buyPropertyGrid(Request $request)
    {
        $properties = Property::with('category')->active()->get();
        return view('site.buy-property-grid',compact('properties'));
    }

    public function home(Request $request)
    {
        $properties = Property::all();
        return view('site.index');
        // return view('site.index',compact('properties'));
    }
    
}
