<?php

namespace App\Imports;

use App\Models\WordFood;
use App\Models\ImportExcelResulte;
use App\Models\Family;
use App\Models\Actor;
use App\Models\Province;
use App\Models\City;
use App\Models\HousingComplex;
use App\Models\FamilyDetailsInfo;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Collection;

class DataImportWithProgress implements ToCollection, WithChunkReading
{
    protected $component;
    protected $totalRows;
    protected $processedRows = 0;

    public function __construct($component, $totalRows)
    {
        $this->component = $component;
        $this->totalRows = $totalRows; // إجمالي عدد الصفوف في الملف
    }

    public function collection(Collection $rows)
    {
        $all = ImportExcelResulte::get();
        foreach ($all as $key => $attribute) {
            $attribute->delete();
        }
        foreach ($rows as $key => $attribute) {
            if ($key < 5) {
                continue;
            }


            if ($attribute[2] != null) {
                // Check if the user already exists
                $user_exest = WordFood::where('id_num', $attribute[2])->first();
              //  $user_data = WordFood::where('id_num', $attribute[3])->first();

                if ($user_exest) {

                    ImportExcelResulte::create([
                        'full_name' => $attribute[1],
                        'id_num' => $attribute[2],
                        'wife_name' => $attribute[3],
                        'wife_id_num' => $attribute[4],
                        'family_count' => $attribute[17],
                        'marital_status' => 1,
                        'mobile' => $attribute[5],
                        'reson' => 'مكرر'
                    ]);
                }  else {

                  $word_food =  WordFood::create([
                        'full_name' => $attribute[1],
                        'id_num' => $attribute[2],
                        'wife_name' => $attribute[3],
                        'wife_id_num' => $attribute[4],
                        'family_count' => $attribute[17],
                        'marital_status' => 1,
                        'mobile' => $attribute[5],
                        'family_id' => Family::where('code', $attribute[8])->first()->id ?? null,
                        'actor_id' => Actor::where('id', $attribute[9])->first()->id ?? null,
                        'status' => 2 // لم يستلم
                    ]);

                    if($word_food){

                        FamilyDetailsInfo::create([
                            'beneficial_id' => $word_food->id,
                            'province' => $this->getId('province', $attribute[6]),
                            'city' => $this->getId('province', $attribute[7]),
                            'housing_complex' => $this->getId('province', $attribute[8]) ,
                            'neighborhood' => $attribute[9],
                            'street' => $attribute[10],
                            'nearest_landmark' => $attribute[11],
                            'is_displaced' => $attribute[12],
                            'is_owner' => $attribute[13],
                            'housing_type' => $attribute[14],
                            'war_damage' => $attribute[15],
                            'damage_type' => $attribute[16],
                            'male_count' => $attribute[17],
                            'female_count' => $attribute[18],
                            'children_under_2' => $attribute[19],
                            'children_under_3' => $attribute[20],
                            'children_5_to_16' => $attribute[21],
                            'document' => $attribute[23],
                            'is_breadwinner_disabled' => $attribute[24],
                            'has_disability' => $attribute[25],
                            'disability_type' => $attribute[26] ?? '-',
                            'has_chronic_disease' => $attribute[27] ?? 'no',
                            'war_victim' => $attribute[28] ?? 'no',
                            'income_source' => $attribute[29],
                            'average_income' => $attribute[30],
                            'is_employee' => $attribute[31],
                            'marital_status' => $attribute[22],
                        ]);

                    }



                }


                // elseif ($user_data == null) {
                //     Log::warning('Invalid ID found: ' . $attribute[3]);

                //     ImportExcelResulte::create([
                //         'full_name' => $attribute[2],
                //         'id_num' => $attribute[3],
                //         'wife_name' => $attribute[4],
                //         'wife_id_num' => $attribute[5],
                //         'family_count' => $attribute[7],
                //         'marital_status' => 1,
                //         'mobile' => $attribute[6],
                //         'reson' => 'رقم الهوية خطأ'
                //     ]);
                // }
            }
        }

        // حساب نسبة التقدم
        $this->processedRows += count($rows);
        $progress = ($this->processedRows / $this->totalRows) * 100;

        // تحديث نسبة التقدم في مكون Livewire
        $this->component->updateProgress($progress);
    }

    public function chunkSize(): int
    {
        return 1500; // تعيين حجم الدفعة
    }

    private function getId($type,$val) {
        if($type == 'province') {
            $province = Province::where('name',$val)->first();
            return $province['id'];
        }

        if($type == 'city') {
            $city = City::where('name',$val)->first()->id;
            return $city['id'];
        }

        if($type == 'housing_complex') {
            $housingComplex = HousingComplex::where('name',$val)->first()->id;
            return $housingComplex['id'];
        }
    }
}
