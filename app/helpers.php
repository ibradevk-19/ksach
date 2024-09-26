<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;



function checkPermission($name, $auth = 'admin')
{


    if (auth($auth)->check()) {

        $roleUserCeheck =   auth($auth)->user()->roles->toArray();

        if ($roleUserCeheck) {

            // check if the role admin status Active and there Permissions

            if (($roleUserCeheck[0]['status'] == 1 && auth($auth)->user()->hasPermissionTo($name))) {

                return true;
            }
        }

        // check if Super Admin
        if (checkSuperAdmin()) {
            return true;
        }
    }
    return false;
}


function checkSuperAdmin()
{

    if (auth('admin')->check()) {

        if (auth('admin')->user()->type == 1) {
            return true;
        }
    }
    return false;
}

function sendEmail($receiver_email, $email_class)
{

    try {

        Mail::to($receiver_email)->queue($email_class);
    } catch (\Throwable $th) {
        dd($th);
    }
}

function apiResponse($data = null, $status = true, $error = [], $message = "", $code = 200)
{

    $array = [
        'data' => $data,
        'status' => $status,
        'message' => $message,
        'error' => is_array($error) ? $error : [$error]
    ];
    return response($array, $code);
}


function dateDiff($date1, $date2)
{
    $date1_ts = strtotime($date1);
    $date2_ts = strtotime($date2);
    $diff = $date2_ts - $date1_ts;
    return round($diff / 86400);
}

function getMinutesBetweenTowDate($date_1, $date_2)
{

    $date_start =  Carbon::parse($date_1);
    $now = Carbon::parse($date_2);
    $difference = date_diff($now, $date_start);
    $minutes = $difference->days * 24 * 60;
    $minutes += $difference->h * 60;
    $minutes += $difference->i;

    return $minutes;
}

function GuardApi(){
 return  auth('api')->user();
}


function checkIdNumber($id_number)
{

    if (auth($auth)->check()) {
        $user = Sokan::where($id_number)->first();
    }

    return false;
}
