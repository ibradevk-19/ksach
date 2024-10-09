<?php

namespace App\Imports;

use App\Models\Family;
use App\Models\Sokan;
use App\Models\WordFood;
use App\Models\Civilrecord;
use App\Models\ImportExcelResulte;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use App\Exports\TaxExport;
use Illuminate\Support\Facades\Log; // Import Log facade

class BeneficialCheckerImport implements ToCollection
{
     /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {

        // $all =  ImportExcelResulte::get();
        // foreach ($all as $key => $attribute) {
        //     $attribute->delete();
        // }




        foreach ($collection as $key => $attribute) {

            try {
                if($key < 6 ) {
                    continue;
                }


                if($attribute[2] != null) {



                    $user_exest = WordFood::where('id_num', $attribute[2])->first();
                    $user_data = Civilrecord::where('ID',$attribute[2])->first();

                    $user_sokan = Sokan::where('id_number',$attribute[2])->first();

                    $wuser_exest = WordFood::where('id_num', $attribute[4])->first();
                    $wuser_data = Civilrecord::where('ID',$attribute[4])->where('Gender', 2)->first();
                    $wuser_sokan = Sokan::where('id_number',$attribute[4])->where('gender','أنثى')->first();

                    if($user_data == null ){
                        $user_data = $user_sokan;
                    }

                    if($wuser_data == null ){
                        $wuser_data = $wuser_sokan;
                    }
                  //try {
                   $user = ImportExcelResulte::create([
                        'full_name' => $attribute[1],
                        'id_num' => $attribute[2],
                        'wife_name' => $attribute[3] ,
                        'wife_id_num' => $attribute[4] ,
                        'family_count'  => 11 ,
                        'marital_status'  => 1,
                        'mobile'  => $attribute[5],
                        'reson' => ($wuser_exest || $user_exest) != null ? 'مكرر' : '---', // مكرر او لا
                        'reson_one' =>  $user_exest != null ? 'مكرر' :  '---',
                        'reson_tow' => $user_data == null ? 'خطاء في رقم الهوية' :  '---',
                        'reson_th' => $wuser_data == null ? 'خطاء في رقم الهوية' :  '---',
                         'actor_id' => 4
                    ]);

                }else {

                }

            } catch (\Throwable $th) {
                  dd($th);
            }

        }


    }
}
