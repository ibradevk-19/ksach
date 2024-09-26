<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileAdmin extends FormRequest
{


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'name'=>['required','regex:/^(?!^\d+$)^.+$/'],
        'email'=>['required','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix','unique:admins,email,'.$this->id],
        'password' =>  ['nullable','required_if:id,null','min:8','max:16','confirmed'],
        'password_confirmation' => 'nullable|required_if:id,null',
        'image' => 'required_if:id,null|image',
        ];
    }

    public function messages()
    {

        return [
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
            'image.required_if' => 'الرجاء رفع صورة ',
            'image.image'=>'الرجاء التأكد من الصورة التي تم رفعها',
        ];
    }
}
