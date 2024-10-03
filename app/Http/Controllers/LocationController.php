<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\HousingComplex;

class LocationController extends Controller
{


    public function getCities($provinceId)
    {
        $cities = City::where('province_id', $provinceId)->get();
        return response()->json($cities);
    }

    public function getHousingComplexes($cityId)
    {
        $housingComplexes = HousingComplex::where('city_id', $cityId)->get();
        return response()->json($housingComplexes);
    }
}
