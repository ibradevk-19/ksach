<?php

namespace App\Imports;

use App\Models\Family;
use App\Models\Sokan;
use App\Models\WordFood;
use App\Models\Civilrecord;
use App\Models\ImportExcelResulte;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use App\Exports\TaxExport;
use Livewire\Component;

class BeneficialCheckerImportCo implements ToCollection, WithHeadingRow
{
    protected $component;
    protected $totalRows;

    public function __construct(Component $component)
    {
        $this->component = $component;
    }

     /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $this->totalRows = $collection->count();
        $processed = 0;

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
                    $user_data = Civilrecord::where('ID',$attribute[3])->first();
                    $user_sokan = Sokan::where('id_number',$attribute[3])->first();
                   
                    $wuser_exest = WordFood::where('id_num', $attribute[5])->first();
                    $wuser_data = Civilrecord::where('ID',$attribute[5])->where('Gender', 2)->first();
                    $wuser_sokan = Sokan::where('id_number',$attribute[5])->where('gender','أنثى')->first();
                   
                    if($user_data == null ){
                        $user_data = $user_sokan;
                    }

                    if($wuser_data == null ){
                        $wuser_data = $wuser_sokan;
                    }

                 $user =  ImportExcelResulte::create([
                        'full_name' => $attribute[2],
                        'id_num' => $attribute[3],
                        'wife_name' => $attribute[4] ,
                        'wife_id_num' => $attribute[5] ,
                        'family_count'  => $attribute[7] ,
                        'marital_status'  => 1,
                        'mobile'  => $attribute[6],
                        'reson' => ($wuser_exest || $user_exest) != null ? 'مكرر' : '---', // مكرر او لا 
                        'reson_one' =>  $user_exest != null ? 'مكرر' :  '---',
                        'reson_tow' => $user_data == null ? 'خطاء في رقم الهوية' :  '---',
                        'reson_th' => $wuser_data == null ? 'خطاء في رقم الهوية' :  '---',
                        'actor_id' =>  $attribute[9],
                    ]); 
                 
                }else {
                    
                }
                
                    if (is_numeric($attribute[3])) {
                        $this->component->checkedNumbers[] = $attribute[3];
                    }

                    // تحديث التقدم
                    $processed++;
                    $this->component->updateProgress(($processed / $this->totalRows) * 100);

            } catch (\Throwable $th) {
                  dd($th);
            }

        }

       
    }
}
