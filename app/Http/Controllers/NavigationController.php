<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\DataTables\NavigationDataTable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use App\Models\Navigation;
use App\Models\Permission;

class NavigationController extends Controller
{
    public function __construct(){
        $this->middleware('can:read manajement/menus');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(NavigationDataTable $dataTable)
    {
        if(Gate::allows('read manajement/menus')){
            return $dataTable->render('manajement.navigation.index');
        }else{
            abort(403,'Anda Tidak Memiliki Akses');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Navigation::whereNull('main_menu')->get();
        return view('manajement.navigation.menu-action', ['navigation' => new Navigation(),'menus' => $menus]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
   
        
        // dd($request->data_url);
        DB::beginTransaction();
        try {
            $navigasi = Navigation::create([
                'name' => $request->name,
                'url' => $request->data_url,
                'main_menu' => $request->main_menu,
                'icon' => $request->icon,
            ]);

            if($request->main_menu == null){
               $newPermission = Permission::create(['name' => 'read '.$navigasi->url]);
               $role = Role::findByName('developer');
               $role->givePermissionTo($newPermission->name);

            }else{

               $getMenus = Navigation::where('id',$request->main_menu)->first();
               $getUrl = 'read '.$getMenus->url;
               
               $main_permission = Permission::where('name',$getUrl)->first();
               
               $default_permission_value = [
                'main_permission' => $main_permission->id,
                'guard_name' => 'web',
                'sort' => 0,
               ];

                $readPermission = Permission::create(array_merge(
                    ['name' => 'read '.$request->data_url],$default_permission_value));

                $role = Role::findByName('developer');
                $role->givePermissionTo($readPermission->name);

                $createPermission = Permission::create(array_merge(
                    ['name' => 'create '.$request->data_url], $default_permission_value));
                
                $role = Role::findByName('developer');
                $role->givePermissionTo($createPermission->name);

                $updatePermission = Permission::create(array_merge(
                    ['name' => 'update '.$request->data_url], $default_permission_value));
                
                $role = Role::findByName('developer');
                $role->givePermissionTo($updatePermission->name);

                $deletePermission = Permission::create(array_merge(
                    ['name' => 'delete '.$request->data_url], $default_permission_value));
               
                $role = Role::findByName('developer');
                $role->givePermissionTo($deletePermission->name);

            }

            DB::commit();
          

            return redirect()->back()->with('success', 'Create Data Success');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
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
        $navigation = Navigation::Find($id);
        $menus = Navigation::Where('main_menu',Null)->orderBy('name')->get();
        return view('manajement.navigation.menu-action',compact('navigation','menus'));
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
            $navigation = Navigation::findOrFail($id);
            $navigation->name = $request->name;
            $navigation->url = $request->data_url;
            $navigation->icon = $request->icon;
            $navigation->main_menu = $request->main_menu;
            $navigation->save();
            
            return redirect()->back()->with('success', 'Update Data Success');

        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
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
        if(Gate::allows('delete manajement/menus')){
            $menu = Navigation::find($id);
        
          
            if($menu->main_menu == null){
                $permission = Permission::where('name','read '.$menu->url)->first();
                $idPermission = Permission::find($permission->id)->delete();
            }else{

                $permission = Permission::where('name','read '.$menu->url)->first();
                $idPermission = Permission::find($permission->id)->delete();
                

                $permission = Permission::where('name','create '.$menu->url)->first();
                $idPermission = Permission::find($permission->id)->delete();
                

                $permission = Permission::where('name','update '.$menu->url)->first();
                $idPermission = Permission::find($permission->id)->delete();
                

                $permission = Permission::where('name','delete '.$menu->url)->first();
                $idPermission = Permission::find($permission->id)->delete();
   
            }
    
            $menu->delete();
            return redirect()->back()->with('success', 'Delete Data Success');
        }else{
            abort(403,'Anda Tidak Memiliki Akses');
        }

       
    }
}
