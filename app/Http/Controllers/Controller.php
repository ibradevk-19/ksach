<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\RedisServices;
use Illuminate\Support\Facades\DB;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function __construct()
    {
        DB::enableQueryLog();
    }

    public function saveModel(Request $request, $model)
    {

        if (Arr::get($request->all(), 'id')) {
            $obj = $model::findOrFail(Arr::get($request->all(), 'id'));
        } else {
            $obj = new $model();
        }

        if (Arr::has($request->all(), 'image')) {

        $obj->image =  $request->file('image')->store('programs');
        }

        if (Arr::has($request->all(), 'sponser_logo')) {

            $obj->sponser_logo =  $request->file('sponser_logo')->store('programs');
            }



        if (($obj instanceof Admin ) && Arr::has($request->all(), 'password')) {
            if ($request->password) {
                $data['password'] = Hash::make($request->password);
                $obj->password = $data['password'];
            }
        }

        //        dd(Arr::except($request->all(), ['flag_image','image','main_image','selected_lng','selected_lat','image2','image3','sort_key', 'cover_image','logo','logo_en','logo_ar'
        //            ,'_token', 'files', 'permissions', 'password','role']));
        $obj->forceFill(Arr::except($request->all(), [
            'flag_image', 'image','sponser_logo', 'main_image', 'selected_lng', 'selected_lat','password_confirmation', 'image2', 'image3', 'sort_key', 'cover_image', 'logo', 'logo_en', 'logo_ar', 'logo_ajar', '_token', 'files', 'permissions', 'password', 'role'
        ]));

        $obj->save();

        if ($obj instanceof Admin) {
            $obj->roles()->detach();
            $obj->assignRole($request->role);
        }
        if ($obj instanceof Role) {
            $obj->syncPermissions($request->permissions);
        }

        return $obj;
    }




    public function apiResponse($data = null, $status = true, $error = [] , $message='Success',$code=200)
    {

        $array = [
            'data' => $data,
            'status' => $status ,
            'message' => $message,
            'error' => is_array($error) ? $error : [$error],
        ];
        if (\request()->has('test'))
            $array['dbQuery'] = DB::getQueryLog();

        return response($array, $code);
    }

    public function deleteItem($model,$id)
    {
        $item = $model::find($id);
        if($item){
            $item->delete();
            return response()->json(['icon' => 'success', 'title' => 'تم الحذف بنجاح ', 'status' => 1], 200);
        }else{
            return response()->json(['icon' => 'error', 'title' => 'لم يتم حذف العنصر', 'status' => 0], 200);
        }

    }


    public function generateValidationErrorMessage($error = null,$data = null,  $statusCode = 400)
    {

        //  this function to Set One Message Error text from Validation

        $data = !$data ?  [] : $data;

        $responseArray = [
            'data' => $data,
            'status' =>false,
            'message' =>'Success',
            'error' => is_array($error) ? $error[0] : $error,

        ];
        return $this->generateResponse($responseArray, $statusCode);

    }

    public  function generateResponse($responseArray, $statusCode)
    {
        return response()->json($responseArray, $statusCode);
    }


    public function getGlobalUser(){
        if(auth('jwt')->user()){
            // dd($user_id = auth('jwt')->user());
             $user =  User::where('global_id',auth('jwt')->user()->user_id)->first();

            if($user){
                RedisServices::setUser($user->id, [
                        'user_id' => $user->id,
                        'full_name' => $user->first_name . ' ' . $user->last_name,
                        'phone' => $user->phone,
                        'email' => $user->email,
                        'score' => $user->score ?? 0,
                    ]);

                return $user;
            }else{
                $user_global =  auth('jwt')->user();
                $access_token= trim(Str::replaceFirst('Bearer ', '', request()->header('Authorization')));
                $newuser =  User::create([
                    'global_id' => $user_global->user_id,
                    'email' => $user_global->email ?$user_global->email : null,
                    'phone' => $user_global->phone ? $user_global->phone : null,
                    'global_token' => $access_token,
                    'first_name' => $user_global->first_name,
                    'last_name' => $user_global->last_name,
                    'image' => $user_global->image,
                    'date_of_birth' => $user_global->date_of_birth,
                    'country_code' => $user_global->country_code,
                    'phone_verified' => $user_global->phone_verified == true ? true : false,
                    'gender' => (int)$user_global->gender,
                    'fcm_token' => request()->header('fcm_token'),
                    'device_type' => $this->getDeviceTypeText($user_global->device_id),
                ]);
                RedisServices::setUser($newuser->id, [
                    'user_id' => $newuser->id,
                    'full_name' => $newuser->first_name . ' ' . $newuser->last_name,
                    'phone' => $newuser->phone,
                    'email' => $newuser->email,
                    'score' => $user->score ?? 0,
                ]);
                return $newuser;
            }
        }else{
            return $this->apiResponse(null, false, "مشكلة في تسجيل الدخول");
        }



    }


    private function getDeviceTypeText($deviceID)
    {
        $devices = [
            //            1 => 'web',
            2 => 'ios',
            3 => 'android',
        ];

        return collect($devices)->first(function ($value, $key) use ($deviceID) {
            return $key == $deviceID;
        });
    }



    
}
