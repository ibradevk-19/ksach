<?php

namespace App\Http\Controllers\Admin\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileAdmin;
use App\Models\Admin;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;




class AdminController extends Controller
{





    public function index(Request $request){
    //  dd(   );
        if ($request->ajax()) {
            $data = Admin::query()->SubAdmin()->select(['id', 'name','email','status']);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.admins.datatables.action') ->addColumn('status_admin','admin.admins.datatables.status_admin')
                ->rawColumns(['action','status_admin'])
                ->make(true);
        }
        return view('admin.admins.index');

    }


    public function create(){
        $roles = Role::all();
        return view('admin.admins.create',compact('roles'));


    }

    public function edit($id){

        $obj = Admin::SubAdmin()->where('id',$id)->first();
        $roles = Role::all();
        if(!$obj)abort(500);

        // dd($obj->roles[0]);

        return view('admin.admins.edit',compact('obj','roles'));


    }


     public function store(Request $request)
    {

        $request->validate([
            'name'=>['required','regex:/^(?!^\d+$)^.+$/'],
            'email'=>['required','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix','unique:admins,email,'.$request->id],
            'password' =>  ['nullable','required_if:id,null','min:8','max:16','confirmed'],
            'password_confirmation' => 'nullable|required_if:id,null',
            'role' => 'required|integer',
            'status'=>'in:0,1',
            'image' => 'required_if:id,null|image',


        ],[
            'name.required'=>'الإسم مطلوب',
            'email.required'=>'البريد الإلكتروني مطلوب',
            'email.regex'=>'صيغة البريد الإلكتروني خاطئة',
            'name.regex'=>'الرجاء كتابة اسم صحيح',


            'email.email'=>'الرجاء إدخال بريد إلكتروني صحيح',
            'email.unique'=>'البريد الإلكتروني مستخدم مسبقاً',
            'password.required_if'=>'الرجاء إدخال كلمة السر',
            'password.min'=>'كلمة السر اقل من 8 أحرف',
            'password.max'=>'كلمة السر أكثر من 16 أحرف',
            'password.regex'=>'يجب أن تكون   كلمة السر مزيجًا من كل من الأحرف الكبيرة والصغيرة بما في ذلك الأحرف الخاصة',

            'password.confirmed'=>'الكلمتان غير متطابقتان',
            'password_confirmation.required_if'=>'الرجاء تأكيد كلمة السر',
            'role.required'=>'يجب إختيار صلاحية',
            'image.required_if' => 'الرجاء رفع صورة ',
            'image.image'=>'الرجاء التأكد من الصورة التي تم رفعها',


        ]);

        // dd($request->all());
        parent::saveModel($request,Admin::class);

        if($request->id) return  redirect()->route('admin.index')->with("success","تم التعديل بنجاح");


       return  redirect()->route('admin.index')->with("success","تم الإنشاء بنجاح");

    }

    public function destroy($id)
    {
        $item = Admin::find($id);
        $item->delete();
        return true;
    }


    public function Profile(){

        $obj = auth('admin')->user();
        return view('admin.admins.profile',compact('obj'));
    }

    public function Profile_update(UpdateProfileAdmin $request){



        $obj = Admin::find(auth('admin')->user()->id);
        $obj->name = $request->get('name');
        $obj->email = $request->get('email');

        if($request->hasFile('image'))
        $obj->image = $request->file("image")->store("grand_prize");


        if($request->has('password'))
        $obj->password = Hash::make($request->password);

        $obj->save();
        return  redirect()->back()->with("success","تم التعديل بنجاح");



    }

}
