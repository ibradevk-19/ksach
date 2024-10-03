<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WordFood;
use App\Models\Province;

class BeneficialController extends Controller
{

    public function crate() {
        $provinces = Province::all();

        return view('frontend.forms.beneficial.index')->with([
            'provinces' => $provinces,
        ]);
    }

    public function store(Request $request) {

         //chech if id exest
         $benf = WordFood::where('id_num',$request->id_num)->first();
         if(!$benf){

           $user = WordFood::create([
                'full_name' => $request->full_name,
                'id_num' => $request->id_num,
                'wife_name' => $request->wife_name,
                'wife_id_num' => $request->wife_id_num,
                'family_count' => $request->family_count,
                'marital_status' => $request->marital_status,
                'mobile' => $request->mobile,
            ]);

            if($user){
                FamilyDetailsInfo::create([
                    'beneficial_id' => $user->id,
                    'province' =>$request->province,
                    'city' =>$request->city,
                    'housing_complex' =>$request->housing_complex,
                    'neighborhood' =>$request->neighborhood,
                    'street' =>$request->street,
                    'nearest_landmark' =>$request->nearest_landmark,
                    'is_displaced' =>$request->is_displaced,
                    'is_owner' =>$request->is_owner,
                    'housing_type' =>$request->housing_type,
                    'war_damage' =>$request->war_damage,
                    'damage_type' =>$request->damage_type,
                    'male_count' =>$request->male_count,
                    'female_count' =>$request->female_count,
                    'children_under_2' =>$request->children_under_2,
                    'children_under_3' =>$request->children_under_3,
                    'children_5_to_16' =>$request->children_5_to_16,
                    'document' =>$request->document,
                    'is_breadwinner_disabled' =>$request->is_breadwinner_disabled,
                    'has_disability' =>$request->has_disability,
                    'disability_type' =>$request->disability_type,
                    'has_chronic_disease' =>$request->has_chronic_disease,
                    'war_victim' =>$request->war_victim,
                    'income_source' =>$request->income_source,
                    'average_income' =>$request->average_income,
                    'is_employee' =>$request->is_employee,
                    'marital_status' =>$request->marital_status,
                ]);
            }

            return 'ok';
         }

         return "Someting Woring";
    }
}
