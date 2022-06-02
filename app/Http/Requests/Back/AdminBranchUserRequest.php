<?php

namespace App\Http\Requests\Back;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class AdminBranchUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $password= $this->request->all()["id"];
        $passwordcontrol=User::where('id',$password)->first();
       
        $rules=[
            'name'=>['required','min:2','max:80'],
            'email'=>['required','email'],
            'branch_id' =>['required'],
            
 
         ];
         if(!isset($passwordcontrol->password))
            {
                $rules['password'] = ['regex:/[a-z]/','regex:/[A-Z]/','regex:/[0-9]/','regex:/[@$!+%*#?&]/','min:8'];
            }
         return $rules;
    }
    public function messages()
    {
        return [
            'password.regex'=>'Şifre büyük küçük harf,rakamlar ve simgelerden oluşmalıdır.',
            'password.min'=>'Şifre 8 karekterli olmalıdır.',
            'name.required'=>'Şube Adı Boş Geçilmez',
            'name.min'=>'Kullanıcı Adı 2 Karakterden Az Olamaz',
            'name.min'=>'Kullanıcı Adı 80 Karakterden Fazla Olamaz',
            'email.required'=>'E mail Boş Geçilmez',
            'email.email'=>'Lürfen Email Adresini Doğru Giriniz.',
            'branch_id.required'=>'Lürfen Şube Seçiniz',


        ];

    }
}
