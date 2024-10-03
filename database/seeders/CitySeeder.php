<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('provinces')->insert(array(
            0 => array(
                'id' => 1,
                'name'=>'شمال غزة',
            ),

            1 => array(
                'id' => 2,
                'name'=>'غزة',
            ),

            2 => array(
                'id' => 3,
                'name'=>'الوسطى',
            ),

            3 => array(
                'id' => 4,
                'name'=>'خانيونس',
            ),

            4 => array(
                'id' => 5,
                'name'=>'رفح',
            ),
        ));


        DB::table('cities')->insert(array(
            0 => array(
                'id' => 1,
                'name'=>'بيت لاهيا',
                'province_id' => 1,
            ),

            1 => array(
                'id' => 2,
                'name'=>'بيت حانون',
                'province_id' => 1,
            ),

            2 => array(
                'id' => 3,
                'name'=>'جباليا',
                'province_id' => 1,
            ),


            4 => array(
                'id' => 5,
                'name'=>'غزة',
                'province_id' => 2,
            ),


            5 => array(
                'id' => 6,
                'name'=>'خانيونس',
                'province_id' => 4,
            ),


            6 => array(
                'id' => 7,
                'name'=>'رفح',
                'province_id' => 5,
            ),


            7 => array(
                'id' => 8,
                'name'=>'دير البلح',
                'province_id' => 3,
            ),

            8 => array(
                'id' => 9,
                'name'=>'النصيرات',
                'province_id' => 3,
            ),


            9 => array(
                'id' => 10,
                'name'=>'البريج',
                'province_id' => 3,
            ),


            10 => array(
                'id' => 11,
                'name'=>'المغازي',
                'province_id' => 3,
            ),

            11 => array(
                'id' => 12,
                'name'=>'الزوايدة',
                'province_id' => 3,
            ),

        ));




        DB::table('housing_complexes')->insert(array(
            0 => array(
                'id' => 1,
                'name'=>'خانيونس البلد',
                'city_id' => 6,
            ),

            1 => array(
                'id' => 2,
                'name'=>'مخيم خانيونس',
                'city_id' => 6,
            ),

            2 => array(
                'id' => 3,
                'name'=>'المواصي خانيونس',
                'city_id' => 6,
            ),

            3 => array(
                'id' => 4,
                'name'=>'قيزان ابو رشوان',
                'city_id' => 6,
            ),

            4 => array(
                'id' => 5,
                'name'=>'قيزان النجار',
                'city_id' => 6,
            ),

            5 => array(
                'id' => 6,
                'name'=>'المحطة',
                'city_id' => 6,
            ),

            6 => array(
                'id' => 7,
                'name'=>'البطن السمين',
                'city_id' => 6,
            ),

            7 => array(
                'id' => 8,
                'name'=>'جورة اللوت',
                'city_id' => 6,
            ),

            8 => array(
                'id' => 9,
                'name'=>'جورة العقاد',
                'city_id' => 6,
            ),

            9 => array(
                'id' => 10,
                'name'=>'معن',
                'city_id' => 6,
            ),

            10 => array(
                'id' => 11,
                'name'=>'الشيخ ناصر',
                'city_id' => 6,
            ),

            11 => array(
                'id' => 12,
                'name'=>'القرارة',
                'city_id' => 6,
            ),

            12 => array(
                'id' => 13,
                'name'=>'بني سهيلا',
                'city_id' => 6,
            ),

            13 => array(
                'id' => 14,
                'name'=>'عبسان الكبيرة',
                'city_id' => 6,
            ),

            14 => array(
                'id' => 15,
                'name'=>'عبسان الجديدة',
                'city_id' => 6,
            ),

            15 => array(
                'id' => 16,
                'name'=>'خزاعة',
                'city_id' => 6,
            ),


            16 => array(
                'id' => 17,
                'name'=>'الفخاري',
                'city_id' => 6,
            ),

            17 => array(
                'id' => 18,
                'name'=>'الاوروبي',
                'city_id' => 6,
            ),


             // بيت لاهيا
            18 => array(
                'id' => 19,
                'name'=>'بيت لاهيا',
                'city_id' => 1,
            ),

            19 => array(
                'id' => 20,
                'name'=>'بيت حانون',
                'city_id' => 2,
            ),

            20 => array(
                'id' => 21,
                'name'=>'جباليا',
                'city_id' => 3,
            ),

            21 => array(
                'id' => 22,
                'name'=>'مخيم جباليا',
                'city_id' => 3,
            ),

            22 => array(
                'id' => 23,
                'name'=>'الرمال',
                'city_id' => 5,
            ),

            23 => array(
                'id' => 24,
                'name'=>'الصبرة',
                'city_id' => 5,
            ),

            24 => array(
                'id' => 25,
                'name'=>'الشجاعية',
                'city_id' => 5,
            ),

            25 => array(
                'id' => 26,
                'name'=>'التفاح',
                'city_id' => 5,
            ),

            26 => array(
                'id' => 27,
                'name'=>'الزيتون',
                'city_id' => 5,
            ),


            27 => array(
                'id' => 28,
                'name'=>'النصر',
                'city_id' => 5,
            ),

            28 => array(
                'id' => 29,
                'name'=>'الدرج',
                'city_id' => 5,
            ),

            29 => array(
                'id' => 30,
                'name'=>'الميناء',
                'city_id' => 5,
            ),

            30 => array(
                'id' => 31,
                'name'=>'الشيخ عجلين',
                'city_id' => 5,
            ),

            31 => array(
                'id' => 32,
                'name'=>'مخيم الشاطئ',
                'city_id' => 5,
            ),


            32 => array(
                'id' => 33,
                'name'=>'الزهراء',
                'city_id' => 5,
            ),

            33 => array(
                'id' => 34,
                'name'=>'المغراقة',
                'city_id' => 5,
            ),

            34 => array(
                'id' => 35,
                'name'=>'الزهراء',
                'city_id' => 5,
            ),


            35 => array(
                'id' => 36,
                'name'=>'جحر الديك',
                'city_id' => 5,
            ),

            36 => array(
                'id' => 37,
                'name'=>'دير البلح',
                'city_id' => 8,
            ),

            37 => array(
                'id' => 38,
                'name'=>'مخيم دير البلح',
                'city_id' => 8,
            ),


            38 => array(
                'id' => 39,
                'name'=>'النصيرات',
                'city_id' => 9,
            ),

            39 => array(
                'id' => 40,
                'name'=>'مخيم النصيرات',
                'city_id' => 9,
            ),

            40 => array(
                'id' => 41,
                'name'=>'البريج',
                'city_id' => 10,
            ),

            41 => array(
                'id' => 42,
                'name'=>'مخيم البريج',
                'city_id' => 10,
            ),


            42 => array(
                'id' => 43,
                'name'=>'مخيم المغازي',
                'city_id' => 11,
            ),


            43 => array(
                'id' => 44,
                'name'=>'المغازي',
                'city_id' => 11,
            ),

            44 => array(
                'id' => 45,
                'name'=>'الزوايدة',
                'city_id' => 12,
            ),


            45 => array(
                'id' => 46,
                'name'=>'المصدر',
                'city_id' => 8,
            ),


            46 => array(
                'id' => 47,
                'name'=>'وادي السلقا',
                'city_id' => 8,
            ),




            47 => array(
                'id' => 48,
                'name'=>'النصر',
                'city_id' => 7,
            ),



            48 => array(
                'id' => 49,
                'name'=>'شوكة',
                'city_id' => 7,
            ),



            49 => array(
                'id' => 50,
                'name'=>'تل السلطان',
                'city_id' => 7,
            ),

            50 => array(
                'id' => 51,
                'name'=>'الشابورة',
                'city_id' => 7,
            ),


            51 => array(
                'id' => 52,
                'name'=>'البرازيل',
                'city_id' => 7,
            ),

            52 => array(
                'id' => 53,
                'name'=>'العودة',
                'city_id' => 7,
            ),

            53 => array(
                'id' => 54,
                'name'=>'رفح الغربية',
                'city_id' => 7,
            ),

            54 => array(
                'id' => 55,
                'name'=>'مخيم يبنا',
                'city_id' => 7,
            ),

            55 => array(
                'id' => 56,
                'name'=>'السلام',
                'city_id' => 7,
            ),
        ));
    }
}




















































