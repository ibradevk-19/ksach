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

class TestController extends Controller
{
    public function checkIdNumber()
    {
        return Civilrecord::where('ID','410194997')->get();
    }

    
}
