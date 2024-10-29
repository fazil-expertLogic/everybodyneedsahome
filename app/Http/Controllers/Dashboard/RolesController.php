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
use App\Models\Menu;
use App\Models\Permission;


class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Role::active();
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%');
            });
        }
        $roles = $query->paginate(10);
        return view('livewire.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::active()->get();
        $menus = Menu::active()->get();
        return view('livewire.role.add',compact('menus','roles'));
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
                'name' => 'required|string|max:255',
                'permissions' => 'array',
                'permissions.*.is_listing' => 'nullable|boolean',
                'permissions.*.is_show' => 'nullable|boolean',
                'permissions.*.is_create' => 'nullable|boolean',
                'permissions.*.is_edit' => 'nullable|boolean',
                'permissions.*.is_delete' => 'nullable|boolean',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $role = Role::create([
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
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'permissions' => 'array',
                'permissions.*.is_listing' => 'nullable|boolean',
                'permissions.*.is_show' => 'nullable|boolean',
                'permissions.*.is_create' => 'nullable|boolean',
                'permissions.*.is_edit' => 'nullable|boolean',
                'permissions.*.is_delete' => 'nullable|boolean',
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
