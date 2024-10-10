<?php

namespace App\Http\Controllers\Actor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WordFood;

class HomeActorController extends Controller
{
    public function home(Request $request){
        $actor_id = \Auth::guard('actor')->user()->id;
        $beneficials = WordFood::with('familyDetailsInfo','deliveryRecordBeneficials','deliveryRecordBeneficials.product')
                                ->where('actor_id',$actor_id)->paginate(15);
        return view('actor.dashbord.index')->with([
            'beneficials' => $beneficials
        ]);
    }
}
