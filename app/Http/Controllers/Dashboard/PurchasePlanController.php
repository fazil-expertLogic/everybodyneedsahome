<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\PurchasePlan;
use App\Models\Membership;
use App\Helpers\Helper;

class PurchasePlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // PurchasePlan::get();
        $allow_show = Helper::check_rights(4)->is_show;
        $allow_create = Helper::check_rights(4)->is_create;
        $allow_edit = Helper::check_rights(4)->is_edit;
        $allow_delete = Helper::check_rights(4)->is_delete;

        $query = PurchasePlan::query();
        
        if ($request->filled('provider_name')) {
            $query->where('provider_name', 'like', '%' . $request->provider_name . '%');
        }
        
        if ($request->filled('provider_email')) {
            $query->where('email', 'like', '%' . $request->provider_email . '%');
        }
        
        if ($request->filled('state')) {
            $query->where('state', 'like', '%' . $request->state . '%');
        }
        
        if ($request->filled('provider_company_name')) {
            $query->where('comany_name', 'like', '%' . $request->provider_company_name . '%');
        }
    
        if ($request->filled('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('provider_name', 'like', '%' . $request->search . '%')
                         ->orWhere('comany_name', 'like', '%' . $request->search . '%');
            });
        }
    
        // Pagination
        $purchase_plans = $query->with('user','membership')->paginate(10);
        return view('livewire.purchase_plan.index', compact('purchase_plans','allow_show','allow_create','allow_edit','allow_delete'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::ClientProvider()->pluck('name','id');
        $member_ships =  Membership::nameWithPrice();
        return view('livewire.purchase_plan.add', compact('users', 'member_ships'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
