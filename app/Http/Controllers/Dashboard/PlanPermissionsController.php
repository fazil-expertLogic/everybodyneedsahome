<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Role;
use App\Models\PlanMenu;
use App\Models\PlanPermission;
use App\Models\Membership;
use App\Models\Permission;
use App\Helpers\Helper;

class PlanPermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allow_show = Helper::check_rights(6)->is_show;
        $allow_create = Helper::check_rights(6)->is_create;
        $allow_edit = Helper::check_rights(6)->is_edit;
        $allow_delete = Helper::check_rights(6)->is_delete;

        $plan_permissions =  PlanPermission::with('membership','planMenu')->get();

    return view('livewire.plan_permissions.index', compact('plan_permissions','allow_show','allow_create','allow_edit','allow_delete'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $membership = Membership::NameWithPrice();
        $plan_menus = PlanMenu::active()->get();
        return view('livewire.plan_permissions.add',compact('membership','plan_menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            return redirect()->route('plan_permissions.index')->with('success', 'Plan Permission apply.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the Plan Permission. Please try again.']);
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
        $role = Role::findOrFail($id);
        $permissions = Permission::where('role_id',$id)->get();
        $menus = Menu::active()->get();
        return view('livewire.role.show', compact('role','menus','permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::where('role_id',$id)->get();
        $menus = Menu::active()->get();
        return view('livewire.role.edit', compact('role','menus','permissions'));
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
            $role = Role::findOrFail($id);
            $role->update([
                'name' =>  $request->name,
            ]);
            // -------------------- permissions --------------------------
            $permissions = $request->input('permissions', []);

            foreach ($permissions as $menuId => $permissionData) {

                $permissionData = array_merge([
                    'is_listing' => 0,
                    'is_show' => 0,
                    'is_create' => 0,
                    'is_edit' => 0,
                    'is_delete' => 0,
                ], $permissionData);

                Permission::updateOrCreate(
                    [
                        'role_id' => $role->id,
                        'menu_id' => $menuId,
                    ],
                    [
                        'is_listing' => $permissionData['is_listing'],
                        'is_show' => $permissionData['is_show'],
                        'is_create' => $permissionData['is_create'],
                        'is_edit' => $permissionData['is_edit'],
                        'is_delete' => $permissionData['is_delete'],
                    ]
                );
            }
            // -------------------- permissions --------------------------
            DB::commit();
            return redirect()->route('roles.index')->with('success', 'Providers create successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the property. Please try again.']);
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
        $roles = Role::findOrFail($id);
        $roles->softDeleteRelations();
        return redirect()->route('roles.index')->with('success', 'user have been soft deleted successfully');
    }
}
