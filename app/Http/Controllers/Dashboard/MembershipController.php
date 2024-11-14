<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use App\Models\Membership;
use App\Models\PlanMenu;
use App\Models\PlanPermission;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allow_show = Helper::check_rights(11)->is_show;
        $allow_create = Helper::check_rights(11)->is_create;
        $allow_edit = Helper::check_rights(11)->is_edit;
        $allow_delete = Helper::check_rights(11)->is_delete;

        $query = Membership::query();
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('price')) {
            $query->where('price', 'like', '%' . $request->price . '%');
        }

        if ($request->filled('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('price', 'like', '%' . $request->search . '%')
                        ->orWhere('plan_type', 'like', '%' . $request->search . '%');
            });
        }

        $memberships = $query->active()->paginate(10);

        return view('livewire.memberships.index', compact('memberships','allow_show','allow_create','allow_edit','allow_delete'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('livewire.memberships.add');
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
                'name'  => 'required|string|max:255',
                'price'  => 'required',
                'features'  => 'required|string|max:255',
                'description'  => 'required|string|max:255',
                'stripe_id' => 'nullable|string|max:255',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            DB::beginTransaction();
            Membership::create([
                'name' => $request->name,
                'price' => $request->price,
                'features' => $request->features,
                'description' => $request->description,
                'plan_type'=> $request->plan_type,
                'stripe_id'=> $request->stripe_id,
            ]);
            DB::commit();
            return redirect()->route('memberships.index')->with('success', 'membership create successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the membership. Please try again.']);
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
        $membership = Membership::findOrFail($id);
        return view('livewire.memberships.show', compact('membership'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $membership = Membership::findOrFail($id);
        return view('livewire.memberships.edit', compact('membership'));
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
                'name'  => 'required|string|max:255',
                'price'  => 'required|string|max:255',
                'features'  => 'required|string|max:255',
                'description'  => 'required|string|max:255',
                'stripe_id' => 'nullable|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            DB::beginTransaction();
            $membership = Membership::findOrFail($id);
            $membership->update([
                'name' => $request->name,
                'price' => $request->price,
                'features' => $request->features,
                'description' => $request->description,
                'plan_type'=> $request->plan_type,
                'stripe_id'=> $request->stripe_id,
            ]);
            DB::commit();
            return redirect()->route('memberships.index')->with('success', 'membership update successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the membership. Please try again.']);
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
        $membership = Membership::findOrFail($id);
        $membership->softDeleteRelations();
        return redirect()->route('memberships.index')->with('success', 'user have been soft deleted successfully');
    }

    public function assign_permission($plan_id)
    {
        
        $membership = Membership::NameWithPrice();
        $plan_menus = PlanMenu::active()->get();
        $plan_permissions = PlanPermission::where('plan_id',$plan_id)->get();

        return view('livewire.memberships.plan_permission',compact('membership','plan_menus','plan_permissions','plan_id'));
    }

    public function post_assign_permission(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'plan_id' => 'required',
                'permissions' => 'array',
                'permissions.*.is_view' => 'nullable|boolean',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            
            // -------------------- permissions --------------------------
            $permissions = $request->input('permissions', []);

            foreach ($permissions as $menuId => $permissionData) {

                $permissionData = array_merge([
                    'is_view' => 0,
                ], $permissionData);

                PlanPermission::updateOrCreate(
                    [
                        'plan_id' => $request->plan_id,
                        'plan_menu_id' => $menuId,
                    ],
                    [
                        'is_view' => $permissionData['is_view'],
                    ]
                );
            }
            // -------------------- permissions --------------------------
            DB::commit();
            return redirect()->route('memberships.index')->with('success', 'Providers create successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the property. Please try again.']);
        }
    }

}
