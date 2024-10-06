<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\FamilyDetailsInfo;
use Illuminate\Support\Facades\Auth;
use App\Models\WordFood;
use App\Models\City;
use App\Models\HousingComplex;

class UserInfoController extends Controller
{
    public function index() {
        $provinces = Province::all();
        $user = Auth::user();
        $beneficial = WordFood::with('actor','familyDetailsInfo','deliveryRecordBeneficials','deliveryRecordBeneficials.product')->where('id_num',$user->id_number)->first();

        return view('frontend.forms.beneficial.update')->with([
            'provinces' => $provinces,
            'cities' => City::get(),
            'housing_complexs' => HousingComplex::get(),
            'beneficial' => $beneficial
        ]);
    }


    public function update(Request $requset) {
        $user = Auth::user();

        $beneficial = WordFood::where('id_num', $user->id_number)->first();

        if($beneficial){
            // $beneficial->update([
            //     'full_name' => $requset->full_name,
            //     'id_num' => $requset->id_num,
            //     'wife_name' => $requset->wife_name,
            //     'wife_id_num' => $requset->wife_id_num,
            //     'family_count' => $requset->family_count,
            //     'marital_status' => 1,
            //     'mobile' => $requset->mobile,
            // ]);
            $info = FamilyDetailsInfo::where('beneficial_id', $beneficial->id)->first();
            if($info){
                $info->update([
                    'beneficial_id' => $beneficial->id,
                    'province' =>  $requset->province,
                    'city' => $requset->city,
                    'housing_complex' => $requset->housing_complex,
                    'neighborhood' => $requset->neighborhood,
                    'street' => $requset->street,
                    'nearest_landmark' => $requset->nearest_landmark,
                    'is_displaced' => $requset->is_displaced,
                    'is_owner' => $requset->is_owner,
                    'housing_type' => $requset->housing_type,
                    'war_damage' => $requset->war_damage,
                    'damage_type' => $requset->damage_type,
                    'male_count' => $requset->male_count,
                    'female_count' => $requset->female_count,
                    'children_under_2' => $requset->children_under_2,
                    'children_under_3' => $requset->children_under_3,
                    'children_5_to_16' => $requset->children_5_to_16,
                    'document' => $requset->document,
                    'is_breadwinner_disabled' => $requset->is_breadwinner_disabled,
                    'has_disability' => $requset->has_disability,
                    'disability_type' => $requset->disability_type,
                    'has_chronic_disease' => $requset->has_chronic_disease,
                    'war_victim' => $requset->war_victim,
                    'income_source' => $requset->income_source,
                    'average_income' => $requset->average_income,
                    'is_employee' => $requset->is_employee,
                    'marital_status' => $requset->marital_status,
                ]);
            }

            return  redirect()->route('dashboard')->with('success', 'تم حفظ البيانات بنجاح');

        }
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
        $key = array_search($val, $array);
        return $key !== false ? $key : null;


    }
}
