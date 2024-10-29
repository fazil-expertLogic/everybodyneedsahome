<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;


class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::active()->paginate(10);
        return view('livewire.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('livewire.menus.add');
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
                'name' => 'required|string|max:255',
                'route' => 'required|string|max:255',
                'icon' => 'required|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            DB::beginTransaction();
            Menu::create([
                'name' =>  $request->name,
                'route' =>  $request->route,
                'icon' =>  $request->icon,
            ]);
            DB::commit();
            return redirect()->route('menus.index')->with('success', 'menu create successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the menu. Please try again.']);
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
        $menu = Menu::findOrFail($id);
        return view('livewire.menus.show', compact('menu'));
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
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'route' => 'required|string|max:255',
                'icon' => 'required|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            DB::beginTransaction();
            $menu = Menu::findOrFail($id);
            $menu->update([
                'name' =>  $request->name,
                'route' =>  $request->route,
                'icon' =>  $request->icon,
            ]);
            DB::commit();
            return redirect()->route('menus.index')->with('success', 'menu create successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the menu. Please try again.']);
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
        $menus = Menu::findOrFail($id);
        $menus->softDeleteRelations();
        return redirect()->route('menus.index')->with('success', 'user have been soft deleted successfully');
    }
}
