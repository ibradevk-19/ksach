<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WordFood;
use App\Models\Province;
use App\Models\FamilyDetailsInfo;
use App\Http\Requests\StoreBeneficialRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class BeneficialController extends Controller
{

    public function crate() {
        $provinces = Province::all();

        return view('frontend.forms.beneficial.index')->with([
            'provinces' => $provinces,
        ]);
    }

    public function store(StoreBeneficialRequest $request)
    {


        // تحقق مما إذا كانت بيانات العائلة موجودة مسبقاً
        if ($this->isBeneficialExists($request->id_num,$request->wife_id_num)) {

            $this->updateBeneficialAndFamilyDetails($request->id_num, $request);
            return redirect()->back()->with('success', 'تم تحديث البيانات بنجاح');
           // return redirect()->back()->with('error', 'بيانات العائلة مسجلة مسبقا');
        }else{
            // إذا كان المستفيد غير موجود، قم بإنشاء مستفيد جديد وتفاصيل الأسرة
            $user = $this->createBeneficial($request);

            if ($user) {
                // إنشاء تفاصيل الأسرة للمستفيد الجديد
                $this->createFamilyDetails($user->id, $request);
                return redirect()->back()->with('success', 'تم حفظ البيانات بنجاح');
            }

            return redirect()->back()->with('error', 'حدث خطأ أثناء حفظ البيانات');
        }


    }

    /**
     * تحقق مما إذا كانت بيانات العائلة موجودة مسبقاً بناءً على رقم الهوية.
     */
    private function isBeneficialExists($idNum,$wife_id_num)
    {
        return WordFood::where('id_num', $idNum)
                            ->orWhere('id_num',$wife_id_num)
                            ->orWhere('wife_id_num',$idNum)
                            ->orWhere('wife_id_num',$wife_id_num)
                            ->exists();
    }

    /**
     * إنشاء مستخدم جديد بناءً على بيانات الطلب.
     */
    private function createBeneficial($request)
    {
        $this->createUser($request);

        return WordFood::create([
            'full_name' => $request->full_name,
            'id_num' => $request->id_num,
            'wife_name' => $request->wife_name,
            'wife_id_num' => $request->wife_id_num,
            'family_count' => $request->family_count,
            'marital_status' => $request->marital_status,
            'mobile' => $request->mobile,
        ]);
    }

    /**
     * إنشاء تفاصيل الأسرة بناءً على معلومات الطلب.
     */
    private function createFamilyDetails($beneficialId, $request)
    {
        FamilyDetailsInfo::create([
            'beneficial_id' => $beneficialId,
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
            'income_source' => $request->income_source ?? 'no',
            'average_income' => $request->average_income ?? 0,
            'is_employee' => $request->is_employee ?? '0',
            'marital_status' => $request->marital_status,
        ]);
    }




        /**
     * تحديث بيانات المستخدم وتفاصيل الأسرة إذا كانت موجودة.
     */
    private function updateBeneficialAndFamilyDetails($id_num, $request)
    {

        $beneficial = WordFood::where('id_num', $id_num)->first();

        if($beneficial){
            $this->createUser($request);

            // تحديث بيانات المستفيد
            $beneficial->update([
                'full_name' => $request->full_name,
                'wife_name' => $request->wife_name,
                'wife_id_num' => $request->wife_id_num,
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

        }
    }


    private function createUser($request) {
        $user = User::where('id_number',$request->id_num)->first();
        if($user){
            return ;
        }
        return User::create([
            'name' => $request->full_name,
            'id_number' => $request->id_num,
            'password' => Hash::make($request->id_num),
            'first_login' => true,
         ]);
    }



}
