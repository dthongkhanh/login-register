<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456789'),
                'role' => UserRole::Admin,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Store',
                'email' => 'store@gmail.com',
                'password' => bcrypt('123456789'),
                'role' => UserRole::Store,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Store 1',
                'email' => 'store1@gmail.com',
                'password' => bcrypt('123456789'),
                'role' => UserRole::Store,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Store 2',
                'email' => 'store2@gmail.com',
                'password' => bcrypt('123456789'),
                'role' => UserRole::Store,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Staff 1',
                'email' => 'staff1@gmail.com',
                'password' => bcrypt('123456789'),
                'role' => UserRole::Staff,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Staff 2',
                'email' => 'staff2@gmail.com',
                'password' => bcrypt('123456789'),
                'role' => UserRole::Staff,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Staff 3',
                'email' => 'staff3@gmail.com',
                'password' => bcrypt('123456789'),
                'role' => UserRole::Staff,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
