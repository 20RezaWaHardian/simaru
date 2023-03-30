<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_user_value = [
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
        
        DB::beginTransaction();
        try {
            $developer = User::create(array_merge([
                'email' => 'repaldi@unja.ac.id',
                'username' => 'developer',
                'name' => 'Repaldi Handi Saputra',
                'usertype' => 'developer',
            ], $default_user_value));

            $admin = User::create(array_merge([
                'email' => 'admin@gmail.com',
                'username' => 'admin',
                'name' => 'admin sistem',
                'usertype' => 'admin'
            ], $default_user_value));
    
            $operator = User::create(array_merge([
                'email' => 'operator@gmail.com',
                'username' => 'operator',
                'name' => 'operator sistem',
                'usertype' => 'operator',
            ], $default_user_value));
            
    
            $role_developer = Role::create(['name' => 'developer']);
            $role_admin = Role::create(['name' => 'admin']);
            $role_operator = Role::create(['name' => 'operator']);
    
            $permission = Permission::create(['name' => 'read dashboard']);

            $permission = Permission::create(['name' => 'read manajement']);
            $permission = Permission::create(['name' => 'read manajement/roles','main_permission' => 2]);
            $permission = Permission::create(['name' => 'create manajement/roles','main_permission' => 2]);
            $permission = Permission::create(['name' => 'update manajement/roles','main_permission' => 2]);
            $permission = Permission::create(['name' => 'delete manajement/roles','main_permission' => 2]);

            $permission = Permission::create(['name' => 'read manajement/permissions','main_permission' => 2]);
            $permission = Permission::create(['name' => 'create manajement/permissions','main_permission' => 2]);
            $permission = Permission::create(['name' => 'update manajement/permissions','main_permission' => 2]);
            $permission = Permission::create(['name' => 'delete manajement/permissions','main_permission' => 2]);

            $permission = Permission::create(['name' => 'read manajement/users','main_permission' => 2]);
            $permission = Permission::create(['name' => 'create manajement/users','main_permission' => 2]);
            $permission = Permission::create(['name' => 'update manajement/users','main_permission' => 2]);
            $permission = Permission::create(['name' => 'delete manajement/users','main_permission' => 2]);

            $permission = Permission::create(['name' => 'read manajement/menus','main_permission' => 2]);
            $permission = Permission::create(['name' => 'create manajement/menus','main_permission' => 2]);
            $permission = Permission::create(['name' => 'update manajement/menus','main_permission' => 2]);
            $permission = Permission::create(['name' => 'delete manajement/menus','main_permission' => 2]);

            $role_developer->givePermissionTo(['read dashboard', 'read manajement','read manajement/roles','create manajement/roles','update manajement/roles','delete manajement/roles',
                                            'read manajement/permissions','create manajement/permissions','update manajement/permissions','delete manajement/permissions',
                                            'read manajement/users','create manajement/users','update manajement/users','delete manajement/users',
                                            'read manajement/menus','create manajement/menus','update manajement/menus','delete manajement/menus',
                                        ]);

          
            // $role_admin->givePermissionTo('create-roles');
            // $role_admin->givePermissionTo('update-roles');
            // $role_admin->givePermissionTo('delete-roles');
    
            $developer->assignRole('developer');
            $admin->assignRole('admin');
            $operator->assignRole('operator');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
        }
        
    }
}
