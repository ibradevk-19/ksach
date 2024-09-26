<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();



        DB::table('permissions')->insert(array(
            0 => array(
                'id' => 1,
                'name'=>'view providers',
                'name_ar'=>'مشاهدة الموردين',
                'guard_name'=>'admin',

            ),

            1 => array(
                'id' => 2,
                'name'=>'edit providers',
                'name_ar'=>'تعديل الموردين',
                'guard_name'=>'admin',

            ),

            2 => array(
                'id' => 3,
                'name'=>'add providers',
                'name_ar'=>'اضافة الموردين',
                'guard_name'=>'admin',

            ),


            3 => array(
                'id' => 4,
                'name'=>'add categories',
                'name_ar'=>'اضافة تصنيف',
                'guard_name'=>'admin',

            ),

            4 => array(
                'id' => 5,
                'name'=>'edit categories',
                'name_ar'=>'تعديل تصنيف',
                'guard_name'=>'admin',

            ),

            5 => array(
                'id' => 6,
                'name'=>'view categories',
                'name_ar'=>'عرض التصنيفات',
                'guard_name'=>'admin',

            ),

            6 => array(
                'id' => 7,
                'name'=>'view products',
                'name_ar'=>'عرض المنتجات',
                'guard_name'=>'admin',

            ),


            7 => array(
                'id' => 8,
                'name'=>'add products',
                'name_ar'=>'اضافة المنتجات',
                'guard_name'=>'admin',

            ),

            8 => array(
                'id' => 9,
                'name'=>'view invoices',
                'name_ar'=>'عرض الفواتير',
                'guard_name'=>'admin',

            ),

            9 => array(
                'id' => 10,
                'name'=>'add invoices',
                'name_ar'=>'اضافة الفواتير',
                'guard_name'=>'admin',

            ),

            10 => array(
                'id' => 11,
                'name'=>'add families',
                'name_ar'=>'اضافة العائلات',
                'guard_name'=>'admin',

            ),

            11 => array(
                'id' => 12,
                'name'=>'view families',
                'name_ar'=>'عرض العائلات',
                'guard_name'=>'admin',

            ),

            12 => array(
                'id' => 13,
                'name'=>'view actors',
                'name_ar'=>'عرض الممثلين',
                'guard_name'=>'admin',

            ),

            13 => array(
                'id' => 14,
                'name'=>'add actors',
                'name_ar'=>'اضافة الممثلين',
                'guard_name'=>'admin',

            ),

            14 => array(
                'id' => 15,
                'name'=>'edit actors',
                'name_ar'=>'تعديل الممثلين',
                'guard_name'=>'admin',

            ),
            
            15 => array(
                'id' => 16,
                'name'=>'edit beneficial',
                'name_ar'=>'تعديل المستفيدين',
                'guard_name'=>'admin',

            ),


            16 => array(
                'id' => 17,
                'name'=>'add beneficial',
                'name_ar'=>'اضافة المستفيدين',
                'guard_name'=>'admin',

            ),
            
            17 => array(
                'id' => 18,
                'name'=>'view beneficial',
                'name_ar'=>'عرض المستفيدين',
                'guard_name'=>'admin',

            ),

            18 => array(
                'id' => 19,
                'name'=>'view delivry',
                'name_ar'=>'عرض دورات التسليم',
                'guard_name'=>'admin',

            ),

            19 => array(
                'id' => 20,
                'name'=>'add delivry',
                'name_ar'=>'اضافة دورات التسليم',
                'guard_name'=>'admin',

            ),

            20 => array(
                'id' => 21,
                'name'=>'show delivry',
                'name_ar'=>'عرض كشف التسليم',
                'guard_name'=>'admin',

            ),

            21 => array(
                'id' => 22,
                'name'=>'delivry all',
                'name_ar'=>'تسليم كشف ',
                'guard_name'=>'admin',

            ),

            22 => array(
                'id' => 23,
                'name'=>'delivry all',
                'name_ar'=>'تسليم كشف الدورة',
                'guard_name'=>'admin',

            ),

            23 => array(
                'id' => 24,
                'name'=>'delivry import',
                'name_ar'=>'استراد كشف الدورة',
                'guard_name'=>'admin',
            ),
        ));

    }
}
