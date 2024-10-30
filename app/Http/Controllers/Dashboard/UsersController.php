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
use App\Helpers\Helper;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allow_show = Helper::check_rights(5)->is_show;
        $allow_create = Helper::check_rights(5)->is_create;
        $allow_edit = Helper::check_rights(5)->is_edit;
        $allow_delete = Helper::check_rights(5)->is_delete;

        // $query = User::active();
        $query = User::query();
        
        if ($request->filled('property_type')) {
            $query->where('property_type', 'like', '%' . $request->property_type . '%');
        }
        
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
    
        if ($request->filled('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->where('name', 'like', '%' . $request->search . '%')
                         ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }
        $users = $query->active()->paginate(10);    
        return view('livewire.user.index', compact('users','allow_show','allow_create','allow_edit','allow_delete'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::active()->get();
        return view('livewire.user.add',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'pass' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
            // return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->pass), 
                'role_id' => $request->role,
            ]);
            DB::commit();
            return redirect()->route('users.index')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            $e->getMessage();
            return redirect()->back()->with('error', 'Failed to create user. Please try again.');
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
        $user = User::findOrFail($id); // Fetch property by ID
        $roles = Role::active()->get();
        return view('livewire.user.show', compact('user','roles')); // Return edit view
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id); // Fetch property by ID
        $roles = Role::active()->get();
        return view('livewire.user.edit', compact('user','roles')); // Return edit view
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'pass' => 'string|min:8|confirmed',
            'role' => 'required|exists:roles,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
            // return redirect()->back()->withErrors($validator)->withInput();
        }
       
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $user->update([   
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->pass), 
                'role_id' => $request->role,
            ]);
            DB::commit();
            return redirect()->route('users.index')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Failed to create user. Please try again.');
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
        $user = User::findOrFail($id);
        $user->softDeleteRelations();
        return redirect()->route('users.index')->with('success', 'user have been soft deleted successfully');
    }
}
