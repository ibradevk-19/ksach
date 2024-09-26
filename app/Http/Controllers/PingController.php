<?php

namespace App\Http\Controllers;

use App\Models\Sokan;
use App\Models\EpisodePrize;
use App\Models\Room;
use App\Models\RoomWinner;
use App\Models\RoomWinnerPrize;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Civilrecord;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserDataResource;
use App\Http\Resources\UserAllResource;

class PingController extends Controller
{
    public function __invoke()
    {
        return Sokan::all()->count();
    }

    public function checkIdNumber($id)  {
         $user = Sokan::where('id_number',$id)->first();
         if($user){
            
            return new UserAllResource($user);

         }else{
            $user_data = Civilrecord::where('ID',$id)->first();

            if($user_data){
                return $user_data;
                return new UserDataResource($user_data);
            }else{
                return [];
            }
            
         }
    }
}
