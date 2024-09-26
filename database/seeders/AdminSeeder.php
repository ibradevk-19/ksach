<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->where('email', '=', 'admin@kasch.com')->delete();
        DB::table('admins')->where('email', '=', 'kasch@kasch.com')->delete();

        DB::table('admins')->insert([
            'name' => 'Administrator',
            'type' => '1',
            'email' => 'admin@kasch.com',
            'password' => Hash::make('kasch@123456789'),
            'created_at' => now(),
        ]);
    }
}
