<?php

namespace App\Services;

use App\Models\FamilyDetailsInfo;

class FamilyDetailsService
{
    public function createFamilyDetails($beneficialId, $request)
    {
        return FamilyDetailsInfo::create([
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
            'disability_type' => $request->disability_type,
            'has_chronic_disease' => $request->has_chronic_disease,
            'war_victim' => $request->war_victim,
            'income_source' => $request->income_source,
            'average_income' => $request->average_income,
            'is_employee' => $request->is_employee,
            'marital_status' => $request->marital_status,
        ]);
    }

    public function updateFamilyDetails($beneficialId, $request)
    {
        return FamilyDetailsInfo::where('beneficial_id', $beneficialId)->update([
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
            'disability_type' => $request->disability_type,
            'has_chronic_disease' => $request->has_chronic_disease,
            'war_victim' => $request->war_victim,
            'income_source' => $request->income_source,
            'average_income' => $request->average_income,
            'is_employee' => $request->is_employee,
            'marital_status' => $request->marital_status,
        ]);
    }
}
