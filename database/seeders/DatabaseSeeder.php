<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table('tbl_role')->insert([
            'name' => 'Admin',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
        DB::table('tbl_role')->insert([
            'name' => 'Manager',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
        DB::table('tbl_user')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role_id' => 1,
            'path_image' => 'uploads/images/admin/admin.png',
            'phone' => '0975041697',
            'address' => '',
            'city_id' => 34,
            'district_id' => 339,
            'ward_id' => 12673,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
        DB::table('tbl_user')->insert([
            'name' => 'Manager',
            'email' => 'manager@gmail.com',
            'password' => bcrypt('manager'),
            'role_id' => 2,
            'path_image' => 'uploads/images/admin/manager.png',
            'phone' => '0988603702',
            'address' => '',
            'city_id' => 2,
            'district_id' => 27,
            'ward_id' => 815,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
    }
}
