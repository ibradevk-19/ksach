<?php

namespace App\Imports;

use App\Models\Family;
use App\Models\Actor;
use App\Models\WordFood;
use App\Models\Civilrecord;
use App\Models\ImportExcelResulte;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class MainImport implements ToCollection
{
     /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        
        $all =  ImportExcelResulte::get();
        foreach ($all as $key => $attribute) {
            $attribute->delete();
        }

    
        foreach ($collection as $key => $attribute) {
            
            try {
                if($key < 4 ) {
                    continue;
                }  
            

                if($attribute[3] != null) {
                    $user_exest = WordFood::where('id_num', $attribute[3])->first();

                    //$user_exest = WordFood::where('id_num', $attribute[3])->orWhere('wife_id_num', $attribute[3])->first();
                    $user_data = Civilrecord::where('ID',$attribute[3])->first();
                    if($user_exest){

                        ImportExcelResulte::create([
                            'full_name' => $attribute[2],
                            'id_num' => $attribute[3],
                            'wife_name' => $attribute[4],
                            'wife_id_num' => $attribute[5],
                            'family_count'  => $attribute[7],
                            'marital_status'  => 1,
                            'mobile'  => $attribute[6],
                            'reson' => 'مكرر'
                        ]); 
                    }elseif($user_data == null){
                        

                            ImportExcelResulte::create([
                                'full_name' => $attribute[2],
                                'id_num' => $attribute[3],
                                'wife_name' => $attribute[4],
                                'wife_id_num' => $attribute[5],
                                'family_count'  => $attribute[7],
                                'marital_status'  => 1,
                                'mobile'  => $attribute[6],
                                'reson' => 'رقم الهوية خطأ'
                            ]); 
                       
                    }else{

                        WordFood::create([
                            'full_name' => $attribute[2],
                            'id_num' => $attribute[3],
                            'wife_name' => $attribute[4],
                            'wife_id_num' => $attribute[5],
                            'family_count'  => $attribute[7],
                            'marital_status'  => 1,
                            'mobile'  => $attribute[6],
                            'family_id' => Family::where('code',$attribute[8])->first()->id ?? null,
                            'actor_id' => Actor::where('id',$attribute[9])->first()->id ?? null,
                            'status' => 2 // لم يستلم
                        ]);


                    }
                 
                }else {
                    
                }

            } catch (\Throwable $th) {
                  return $th;
            }

        }
    }
}
