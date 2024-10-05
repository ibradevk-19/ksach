<?php

namespace App\Services;

use App\Models\WordFood;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class BeneficialService
{
    public function createBeneficial($request)
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

    public function updateBeneficial($beneficial, $request)
    {
        $this->createUser($request);

        return $beneficial->update([
            'full_name' => $request->full_name,
            'wife_name' => $request->wife_name,
            'wife_id_num' => $request->wife_id_num,
            'family_count' => $request->family_count,
            'marital_status' => $request->marital_status,
            'mobile' => $request->mobile,
        ]);
    }

    public function createUser($request)
    {
        return User::create([
            'name' => $request->full_name,
            'id_number' => $request->id_num,
            'password' => Hash::make($request->id_num),
        ]);
    }

    public function isBeneficialExists($idNum, $wifeIdNum)
    {
        return WordFood::where('id_num', $idNum)
                        ->orWhere('id_num', $wifeIdNum)
                        ->orWhere('wife_id_num', $idNum)
                        ->orWhere('wife_id_num', $wifeIdNum)
                        ->exists();
    }
}
