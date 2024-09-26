<?php

namespace App\Imports;

use App\Models\Family;
use App\Models\WordFood;
use App\Models\Actor;
use App\Models\Sokan;
use App\Models\DeliveryRecordBeneficial;
use App\Models\ImportExcelResulte;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use App\Models\Civilrecord;

class DeliveryRecordImport implements ToCollection
{
    public $delivry_id;
    public $product_id;

    public function __construct($delivry_id,$product_id)
    {
        $this->delivry_id = $delivry_id;
        $this->product_id = $product_id;
    }
     /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        
     
    
        foreach ($collection as $key => $attribute) {
            
            try {
                if($key < 4 ) {
                    continue;
                }  
                $chek_if_user_exest = WordFood::where('id_num', $attribute[3])->first();

                //$chek_if_user_exest = WordFood::where('id_num', $attribute[3])->orWhere('wife_id_num', $attribute[3])->first();
                // $chek_if_exest = DeliveryRecordBeneficial::where('delivery_record_id', $this->delivry_id)->orWhere('wife_id_num', $attribute[3])->first();

                if($attribute[3] != null) {
                   
                    if($chek_if_user_exest){
                       $chek_if_exest = DeliveryRecordBeneficial::where('beneficial_id', $chek_if_user_exest->id)->first();
                       if($chek_if_exest){

                       }else{
                         DeliveryRecordBeneficial::create([
                            'delivery_record_id' => $this->delivry_id,
                            'beneficial_id' => $chek_if_user_exest->id,
                            'product_id' => $this->product_id,
                            'status' => 1 // not reseve eet
                         ]);
                       }
                       
                    }else{
                      $user_data = Civilrecord::where('ID',$attribute[3])->first();
                      $user_sokan = Sokan::where('id_number',$attribute[3])->first();

                      $chek_if_wuser_exest = WordFood::where('wife_id_num', $attribute[3])->first();
                       if($chek_if_wuser_exest){

                       }else{
                        if($user_data || $user_sokan ){
                            $user =  WordFood::create([
                                'full_name' => $attribute[2],
                                'id_num' => $attribute[3],
                                'wife_name' => $attribute[4],
                                'wife_id_num' => $attribute[5],
                                'family_count'  => $attribute[7],
                                'marital_status'  => 1,
                                'mobile'  => $attribute[6],
                                'family_id' => Family::where('code',$attribute[8])->first()->id ?? null,
                                'actor_id' => Actor::where('id',$attribute[9])->first()->id ?? null,
                                'status' => 1
                            ]);
    
                            if($user){
                                $chek_if_exest = DeliveryRecordBeneficial::where('beneficial_id', $user->id)->first();
                                    if($chek_if_exest){
                                        
                                    }else{
                                        DeliveryRecordBeneficial::create([
                                            'delivery_record_id' => $this->delivry_id,
                                            'beneficial_id' => $user->id,
                                            'product_id' => $this->product_id,
                                            'status' => 1 // not reseve eet
                                        ]);
                                    }
    
                               
                            }
                          }
                       }
                   
                    
                    }
                 
                }else {
                    
                }

            } catch (\Throwable $th) {
                dd( $th);
            }

        }
    }
}
