<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;
use App\Models\Role;
use App\Models\Permission;

class permissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        return view('livewire.permissions.add',compact('menus','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // Validate the input
        $request->validate([
            'role' => 'required|exists:roles,id',
            'permissions' => 'array',
            'permissions.*.is_listing' => 'nullable|boolean',
            'permissions.*.is_show' => 'nullable|boolean',
            'permissions.*.is_create' => 'nullable|boolean',
            'permissions.*.is_edit' => 'nullable|boolean',
            'permissions.*.is_delete' => 'nullable|boolean',
        ]);

        $roleId = $request->input('role');
        $permissions = $request->input('permissions', []);

        foreach ($permissions as $menuId => $permissionData) {
            // Set default values for checkboxes that may not be checked
            $permissionData = array_merge([
                'is_listing' => 0,
                'is_show' => 0,
                'is_create' => 0,
                'is_edit' => 0,
                'is_delete' => 0,
            ], $permissionData);
            Permission::updateOrCreate(
                [
                    'role_id' => $roleId,
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

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Permissions saved successfully!');
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
