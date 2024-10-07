<?php

namespace App\Imports;

use App\Models\WordFood;
use App\Models\ImportExcelResulte;
use App\Models\Family;
use App\Models\Actor;
use App\Models\Province;
use App\Models\City;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
    protected $actor_id;

    public function __construct($component, $totalRows,$actor_id)
    {
        $this->component = $component;
        $this->totalRows = $totalRows; // إجمالي عدد الصفوف في الملف
        $this->actor_id = $actor_id;
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

            if ($this->isEmptyRow($attribute)) {
                continue; // تخطي الصف الفارغ
            }
            if ($attribute[2] != null) {
                // Check if the user already exists
                $user_exest = WordFood::where('id_num', $attribute[2])->first();
              // $user_data = WordFood::where('id_num', $attribute[3])->first();


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
                        'actor_id' => $this->actor_id ?? null,
                        'status' => 2 // لم يستلم
                    ]);

                    if($word_food){

                        FamilyDetailsInfo::create([
                            'beneficial_id' => $word_food->id,
                            'province' => $this->getId('province', $attribute[6]),
                            'city' => $this->getId('city', $attribute[7]),
                            'housing_complex' => $this->getId('housing_complex', $attribute[8]) ,
                            'neighborhood' => $attribute[9],
                            'street' => $attribute[10],
                            'nearest_landmark' => $attribute[11],
                            'is_displaced' => trim($attribute[12]) == 'نازح' ? 0 : 1,
                            'is_owner' =>  $this->ArToEn(trim($attribute[13]))  ?? '-',
                            'housing_type' => $this->ArToEn($attribute[14])  ?? '-',
                            'war_damage' => $attribute[15] == 'نعم' ? 1 : 0,
                            'damage_type' => $this->ArToEn($attribute[16]),
                            'male_count' => $attribute[18],
                            'female_count' => $attribute[19],
                            'children_under_2' => $attribute[20],
                            'children_under_3' => $attribute[21],
                            'children_5_to_16' => $attribute[22],
                            'document' => $this->ArToEn($attribute[24])  ?? '-',
                            'is_breadwinner_disabled' => $attribute[25] == 'نعم' ? 1 : 0,
                            'has_disability' => $attribute[26]  == 'نعم' ? 1 : 0,
                            'disability_type' => $this->ArToEn($attribute[27])  ?? '-',
                            'has_chronic_disease' => $attribute[28] == 'نعم' ? 1 : 0,
                            'war_victim' => $attribute[29] == 'نعم' ? 1 : 0,
                            'income_source' => $attribute[30]  == 'نعم' ? 1 : 0,
                            'average_income' => $attribute[31] ?? 0,
                            'is_employee' => $attribute[32] == 'نعم' ? 1 : 0,
                            'marital_status' =>  $this->ArToEn(trim($attribute[23]))  ?? '-',
                        ]);
                        try {
                            User::create([
                                'name' => $attribute[1],
                                'id_number' => $attribute[2],
                                'password' => Hash::make($attribute[2]),
                            ]);
                        } catch (\Throwable $th) {
                            //throw $th;
                        }


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
            return $province = Province::where('name',$val)->first()->id ?? null;
        }

        if($type == 'city') {
            return City::where('name',$val)->first()->id ?? null;
        }

        if($type == 'housing_complex') {
            return HousingComplex::where('name',$val)->first()->id ?? null;

        }
    }


    public function isEmptyRow($row)
    {
        // التحقق من أن جميع الخلايا في الصف فارغة
        // نستخدم array_filter لإزالة القيم الفارغة في الصف
        return empty(array_filter($row->toArray()));
    }


    private function ArToEn($val)  {
        $array = [
            'visual_impairment' => 'إعاقة بصرية',
            'hearing_disability' => 'إعاقة سمعية',
            'movement_disability' => 'إعاقة حركية',
            'mental_disability' => 'إعاقة عقلية',
            'psychological_disability' => 'إعاقة نفسية',
            'speech_disability' => 'إعاقة نطقية',
            'social_disability' => 'إعاقة اجتماعية (التوحد أو اضطرابات التواصل)',
            'sensory_impairment' => 'إعاقة حسية',
            'multiple_disabilities' => 'إعاقة متعددة',
            '1' => 'ملك',
            '1' => 'ملكية عائلية',
            '1' => 'ملكية خاصة',
            '0' => 'عقد إيجار',
            '0' => 'إجار',
            'concrete' => 'باطون',
            'asbestos_sheets' => 'زينقو',
            'total_damage' => 'ضرر كلي',
            'partial_damage' => 'ضرر جزئي',
            'uninhabitable_part' => 'جزئي غير قابل للسكن',
            'inhabitable_part' => 'جزئي قابل للسكن',
            'palestinian_identity' => 'هوية فلسطينية',
            'passport' => 'جواز سفر',
            'identification_number' => 'رقم تعريف',
            'jordanian_document' => 'وثيقة اردنية',
            'other' => 'اخرى',
            'single' => 'أعزب',
            'married' => 'متزوج',
            'married' => 'متزوجة',
            'divorced' => 'مطلق',
            'divorced'=> 'مطلقة',
            'widowed' => 'ارمل',
            'widowed' => 'ارملة',
            'breadwinner' => 'بلا معيل',
        ];

        // Search for the value and return the corresponding key
        $key = array_search(trim($val), $array);
        return $key !== false ? $key : null;


    }

}
