<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail;
use App\Models\Category;
use App\Models\Property;
use App\Models\Membership;
use App\Models\Amenity;
use App\Models\PropertyReview;
use App\Models\ContactUs;


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

    public function propertyDetail($id)
    {
        $property = Property::findOrFail($id);
        if($property->property_amenities){
            $propertyAmenities = json_decode($property->property_amenities, true);
            $amenities = Amenity::whereIn('id', $propertyAmenities)->active()->get();
        }else{
            $amenities = null;
        }
        $propertyReviewes = PropertyReview::where('property_id', $id)->active()->get();
        return view('site.buy-details', compact('property', 'amenities','propertyReviewes'));
    }

    public function propertyReviews(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'reviewer_name' => 'required|string|max:255',
            'reviewer_email' => 'required|email|max:255',
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);
        if ($validator->fails()) {
            dd($validator->errors());
            return response()->json($validator->errors(), 422);
        }
        DB::beginTransaction();
        try {
            PropertyReview::create([
                'reviewer_name' => $request['reviewer_name'],
                'reviewer_email' => $request['reviewer_email'],
                'comment' => $request['comment'],
                'rating' => $request['rating'],
                'property_id'  => $request['property_id'],
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Review submitted successfully!');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback if any operation fails
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the property. Please try again.']);
        }
    }

    public function contactUs(){
        return view('site.contact-us');
    }   

    public function contactUsSendEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'comment' => 'required|string',
        ]);

        if ($validator->fails()) {
            dd($validator->errors());
            return response()->json($validator->errors(), 422);
        }

        DB::beginTransaction();
        try {
            ContactUs::create([
                "name" => $request->name,
                "phone" => $request->phone,
                "email" => $request->email,
                "subject" => $request->subject,
                "comment" => $request->comment,
            ]);
            // Email
            $data = [
                'name' => $request->name,
                'message' => 'Thank you for contact Us. We had recived your Email'
            ];
            Mail::to($request->email)->send(new ContactUsMail($data));
            DB::commit();
            return redirect()->back()->with('success', 'Thank you for contacting us! We have received your message.');
            // Email
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback if any operation fails
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the property. Please try again.']);
        }
    }
}
