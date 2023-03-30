<?php

use App\Models\Navigation;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;


if(!function_exists('getMenus')){
    function getMenus()
    {
        
        return Navigation::select('navigation.*')
        ->with('subMenus')->whereNull('main_menu')->orderby('navigation.name')->get();
        // return Navigation::whereExists(function($r){
        //     $r->select(DB::raw(1))->from('role_has_menus as b')
        //         ->whereRaw('b.menu_id = navigation.id')
        //         ->whereIn('b.role_id',Auth::user()->roles->pluck('id'));
        // })
        // ->orderby('navigation.name')
        // ->get();
        // return Navigation::select('navigation.*')->leftjoin('role_has_menus as b', 'b.menu_id', '=', 'navigation.id')->whereIn('b.role_id',Auth::user()->roles->pluck('id'))
        // ->with('subMenus')->whereNull('main_menu')
        // ->orderby('navigation.name')
        // ->get();
        
    }
}

// if(!function_exists('setMenus')){
//     function setMenus()
//     {
//         return Navigation::select('navigation.*')
//                ->with('subMenus')->whereNull('main_menu')->get();
//     }
// }

if(!function_exists('setPermissions')){
    function setPermissions()
    {
        return Permission::select('permissions.*')->with('subPermissions')->whereNull('main_permission')->orderby('permissions.name')->get();
    }
}


