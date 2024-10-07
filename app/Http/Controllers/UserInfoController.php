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


    public function update(Request $request) {
        $user = Auth::user();

        $beneficial = WordFood::where('id_num', $user->id_number)->first();

        if($beneficial){

            // تحديث بيانات المستفيد
            $beneficial->update([
                'family_count' => $request->family_count,
                'marital_status' => $request->marital_status,
                'mobile' => $request->mobile,
            ]);



            // Create or update family details
            FamilyDetailsInfo::updateOrCreate(
                ['beneficial_id' => $beneficial->id], // criteria for finding the record
                [
                    'province' => $request->province,
                    'city' => $request->city,
                    'housing_complex' => $request->housing_complex,
                    'neighborhood' => $request->neighborhood,
                    'street' => $request->street,
                    'nearest_landmark' => $request->nearest_landmark,
                    'is_displaced' => $request->is_displaced,
                    'is_owner' => $request->is_owner,
                    'housing_type' => $request->housing_type,
                    'war_damage' => $request->war_damage,
                    'damage_type' => $request->damage_type,
                    'male_count' => $request->male_count,
                    'female_count' => $request->female_count,
                    'children_under_2' => $request->children_under_2,
                    'children_under_3' => $request->children_under_3,
                    'children_5_to_16' => $request->children_5_to_16,
                    'document' => $request->document,
                    'is_breadwinner_disabled' => $request->is_breadwinner_disabled,
                    'has_disability' => $request->has_disability,
                    'disability_type' => $request->disability_type ?? '-',
                    'has_chronic_disease' => $request->has_chronic_disease,
                    'war_victim' => $request->war_victim,
                    'income_source' => $request->income_source ?? '0',
                    'average_income' => $request->average_income ?? 0,
                    'is_employee' => $request->is_employee ?? '0',
                    'marital_status' => $request->marital_status,
                ]
            );


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
