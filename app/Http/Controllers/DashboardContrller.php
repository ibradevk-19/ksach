<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WordFood;

class DashboardContrller extends Controller
{
    public function index()  {
        $user = Auth::user();
        $beneficial = WordFood::with('actor','familyDetailsInfo','deliveryRecordBeneficials','deliveryRecordBeneficials.product')->where('id_num',$user->id_number)->first();

        return view('dashboard')->with([
            'beneficial' => $beneficial,
        ]);
    }



}
