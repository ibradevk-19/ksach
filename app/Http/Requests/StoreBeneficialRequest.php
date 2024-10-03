<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBeneficialRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'full_name' => 'required|string|max:255',
            'id_num' => 'required|numeric|digits_between:9,9',
            'wife_name' => 'nullable|string|max:255',
            'wife_id_num' => 'nullable|numeric',
            'marital_status' => 'required|string',
            'mobile' => 'required|numeric',
            'family_count' => 'required|integer',
            'male_count' => 'required|integer',
            'female_count' => 'required|integer',
            'children_under_2' => 'required|integer',
            'children_under_3' => 'required|integer',
            'children_5_to_16' => 'required|integer',
            'document' => 'required|string',
            'is_breadwinner_disabled' => 'required|string',
            'has_disability' => 'required|string',
            'disability_type' => 'required_if:has_disability,yes',
            'has_chronic_disease' => 'required|string',
            'war_victim' => 'required|string',
            'income_source' => 'required|string',
            'is_employee' => 'required|string',
            'average_income' => 'required|numeric',
            'province' => 'required|exists:provinces,id',
            'city' => 'required|exists:cities,id',
            'housing_complex' => 'required|string',
            'neighborhood' => 'required|string',
            'street' => 'required|string',
            'nearest_landmark' => 'required|string',
            'is_displaced' => 'required|string',
            'is_owner' => 'required|string',
            'housing_type' => 'required|string',
            'war_damage' => 'required|string',
            'damage_type' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'الحقل :attribute مطلوب.',
            'string' => 'الحقل :attribute يجب أن يكون نص.',
            'numeric' => 'الحقل :attribute يجب أن يكون رقم.',
            'integer' => 'الحقل :attribute يجب أن يكون عدد صحيح.',
            'max' => 'الحقل :attribute يجب ألا يتجاوز :max حرف.',
            'exists' => 'القيمة المختارة لـ :attribute غير صالحة.',
            'digits_between' => 'الحقل :attribute يجب أن يكون مكون من :min إلى :max أرقام.',
            'required_if' => 'الحقل :attribute مطلوب عندما يكون الحقل :other مساوياً لـ :value.',
        ];
    }

    public function attributes()
    {
        return [
            'full_name' => 'اسم المعيل',
            'id_num' => 'رقم هوية المعيل',
            'wife_name' => 'اسم الزوجة',
            'wife_id_num' => 'رقم هوية الزوجة',
            'marital_status' => 'الحالة الاجتماعية',
            'mobile' => 'رقم الجوال',
            'family_count' => 'عدد أفراد الأسرة',
            'male_count' => 'عدد الذكور',
            'female_count' => 'عدد الإناث',
            'children_under_2' => 'عدد الأطفال أقل من سنتين',
            'children_under_3' => 'عدد الأطفال أقل من 3 سنوات',
            'children_5_to_16' => 'عدد الأطفال من 5 إلى 16 سنة',
            'document' => 'الوثيقة',
            'is_breadwinner_disabled' => 'هل المعيل معاق',
            'has_disability' => 'هل المعيل ذو إعاقة',
            'disability_type' => 'نوع الإعاقة',
            'has_chronic_disease' => 'هل لديه أمراض مزمنة',
            'war_victim' => 'هل يوجد فقيد حرب',
            'income_source' => 'هل يوجد مصدر دخل',
            'is_employee' => 'هل المعيل موظف',
            'average_income' => 'متوسط الدخل',
            'province' => 'المحافظة',
            'city' => 'المدينة',
            'housing_complex' => 'التجمع السكني',
            'neighborhood' => 'الحي',
            'street' => 'الشارع',
            'nearest_landmark' => 'أقرب معلم',
            'is_displaced' => 'نازح / مقيم',
            'is_owner' => 'ملكية السكن',
            'housing_type' => 'نوع السكن',
            'war_damage' => 'هل يوجد أضرار حرب 2023',
            'damage_type' => 'نوع الضرر',
        ];
    }
}
