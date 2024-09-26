<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert(array(

            24 => array(
                'id' => 25,
                'name'=>'view store',
                'name_ar'=>'المخزن',
                'guard_name'=>'admin',
            ),

            25 => array(
                'id' => 26,
                'name'=>'mang delivry',
                'name_ar'=>'ادارة التسليم',
                'guard_name'=>'admin',
            ),

            

            26 => array(
                'id' => 27,
                'name'=>'mang actors',
                'name_ar'=>'ادارة الممثلين',
                'guard_name'=>'admin',
            ),
            
            27 => array(
                'id' => 28,
                'name'=>'mang families',
                'name_ar'=>'ادارة الممثلين',
                'guard_name'=>'admin',
            ),
            
            28 => array(
                'id' => 29,
                'name'=>'mang invoices',
                'name_ar'=>'ادارة الفواتير',
                'guard_name'=>'admin',
            ),
            
            29 => array(
                'id' => 30,
                'name'=>'mang providers',
                'name_ar'=>'ادارة الموردين',
                'guard_name'=>'admin',
            ),
            
            30 => array(
                'id' => 31,
                'name'=>'mang categories',
                'name_ar'=>'ادارة التصنيفات',
                'guard_name'=>'admin',
            ),
            
            
            31 => array(
                'id' => 32,
                'name'=>'mang products',
                'name_ar'=>'ادارة المنتجات',
                'guard_name'=>'admin',
            ),
            
            32 => array(
                'id' => 33,
                'name'=>'mang beneficial',
                'name_ar'=>'ادارة التسليم',
                'guard_name'=>'admin',
            ),
            
        ));        
    }
}
