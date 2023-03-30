<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\DataTables\UserDataTable;
use App\DataTables\LoginDataTable;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;
use Auth;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('can:read manajement/users');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $dataTable)
    {
       
        return $dataTable->render('manajement.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginDataTable $dataTable)
    {
        return $dataTable->render('manajement.user.user-login');
    }

    public function loginAs($id)
    {

       $user = User::findorfail($id);
       if(Gate::allows('create manajement/users')){
            if($user){
                
                Auth::login($user, true);
                session()->regenerate();
                return redirect()->intended(RouteServiceProvider::HOME);
            }else{
                return redirect()->back()->with('error','Login Tidak Bisa Dilakukan!');
            }
       }else{
            abort(403,'Anda Tidak Memiliki Akses');
       }
    }

    public function create()
    {
        return view('manajement.user.user-action', ['user' => new User()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        
        $default_user_value = [
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),

        ];
        
        DB::beginTransaction();
        try {
            User::create(array_merge([
                'email' => $request->email,
                'username' => $request->username,
                'name' => $request->name,
            ], $default_user_value));

            DB::commit();

            return redirect()->back()->with('success', 'Create Data Success');
        
        } catch (\Exception $e) {
            DB::rollback();
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
        $user = User::Find($id);
        $getRole = Role::get();
      
        return view('manajement.user.user-action',compact(['user','getRole']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        if(Gate::allows('update manajement/users')){
            try{
                $user = User::findOrFail($id);
                $user->usertype = $request->usertype;
                $user->save();
        
                $user->syncRoles($request->usertypes);

                return redirect()->back()->with('success', 'Create Data Success');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        }else{
            abort(403,'Anda Tidak Memiliki Akses');
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
        if(Gate::allows('delete manajement/users')){
            $user = User::find($id);
            $user->delete();
            return redirect()->back()->with('success', 'Delete Data Success');
        }else{
            abort(403,'Anda Tidak Memiliki Akses');
        }
    }
}
