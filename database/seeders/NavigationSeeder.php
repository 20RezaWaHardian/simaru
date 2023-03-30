<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Navigation;
class NavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Navigation::create([
            'name' => 'Dashboard',
            'url' =>'dashboard',
            'icon' =>'fas fa-warehouse',
            'main_menu' => Null,
        ]);

        Navigation::create([
            'name' => 'Manajement',
            'url' =>'manajement',
            'icon' =>'fas fa-columns',
            'main_menu' => Null,
        ]);

        Navigation::create([
            'name' => 'Roles Manajement',
            'url' =>'manajement/roles',
            'icon' =>Null,
            'main_menu' => 2,
        ]);

        Navigation::create([
            'name' => 'Permissions Manajement',
            'url' =>'manajement/permissions',
            'icon' =>Null,
            'main_menu' => 2,
        ]);

        Navigation::create([
            'name' => 'Users Manajement',
            'url' =>'manajement/users',
            'icon' =>Null,
            'main_menu' => 2,
        ]);

        Navigation::create([
            'name' => 'Menus Manajement',
            'url' =>'manajement/menus',
            'icon' =>Null,
            'main_menu' => 2,
        ]);

        //TEST

        // Navigation::create([
        //     'name' => 'Test',
        //     'url' =>'#',
        //     'icon' =>'fas fa-columns',
        //     'main_menu' => Null,
        // ]);

        // Navigation::create([
        //     'name' => 'Roles Test',
        //     'url' =>'test/roles',
        //     'icon' =>Null,
        //     'main_menu' => 5,
        // ]);

        // Navigation::create([
        //     'name' => 'Permissions Test',
        //     'url' =>'test/permissions',
        //     'icon' =>Null,
        //     'main_menu' => 5,
        // ]);

        // Navigation::create([
        //     'name' => 'Users Test',
        //     'url' =>'test/users',
        //     'icon' =>Null,
        //     'main_menu' => 5,
        // ]);
    }
}
