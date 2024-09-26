<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('families')->insert([
            'name' => 'ابو ظريفة',
            'code' => 'so-f1',
        ]);

        DB::table('families')->insert([
            'name' => 'ابو اسماعيل',
            'code' => 'so-f2',
        ]);

        DB::table('families')->insert([
            'name' => 'ابو دقة',
            'code' => 'so-f3',
        ]);
    }
}
