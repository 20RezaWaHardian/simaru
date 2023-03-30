<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\RoleRequest;
use App\DataTables\RoleDataTable;
use App\Models\Role;
use App\Models\Navigation;
use App\Models\User;
use DB;

class RoleController extends Controller
{
    public function __construct(){
        $this->middleware('can:read manajement/roles');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RoleDataTable $dataTable)
    {
      
        
        return $dataTable->render('manajement.role.index');
        // return view('manajement.role.index');
        // $this->authorize('read-role');
        // if(Gate::allows('read-role')){
        //     return view('manajement.role.index');
        // }
        //     abort(403,'Anda Tidak Memiliki Akses');
        
        // return "OK";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
        return view('manajement.role.role-action', ['role' => new Role()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Create Data Success'
        ]);
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
        $role = Role::Find($id);
      
        return view('manajement.role.role-action',compact('role'));
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
        $role = Role::findOrFail($id);
        
        $role->name = $request->name;
        $role->guard_name = $request->guard_name;
        $role->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Update Data Success'
        ]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete manajement/roles');

        $role = Role::find($id);
        $role->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Delete Data Success'
        ]);
    }

    // public function setHakAkses($id)
    // {
       
    //     if(!function_exists('setMenus')){
    //         function setMenus()
    //         {
    //             return Navigation::with('subMenus')->whereNull('main_menu')->get();
    //         }
    //     }

    //     $role = Role::Find($id);
    //     $roleMenus = DB::table('role_has_menus as a')->where('role_id',$id)->pluck('menu_id')->toArray();
        

    //     return view('manajement.role.role-hak-akses',compact(['role','roleMenus']));
    // }

    // public function sycHakAkses(Request $request, $id) {
       
    
    //     $role = Role::find($id);
    //     $role->navigation()->sync($request->menus);
        
        
    //     return redirect()->back()->with('success', 'Berhasil');
    // }

    public function setPermission($id)
    {
        $role = Role::Find($id);
        // $roleMenus = DB::table('role_has_menus as a')->where('role_id',$id)->pluck('menu_id')->toArray();
        $rolePermissions = DB::table('role_has_permissions as a')->where('role_id',$id)->pluck('permission_id')->toArray();
        
        // return view('manajement.role.role-permission',compact(['role','rolePermissions','roleMenus']));
        return view('manajement.role.role-permission',compact(['role','rolePermissions']));
    }

    public function sycPermission(Request $request, $id) {
       
        $role = Role::find($id);
        // $role->syncPermissions($request->permissions);
        $role->syncPermissions($request->permissions);
        
        return redirect()->back()->with('success', 'Berhasil');
    }
}
