<?php

namespace App\Http\Requests;

use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
         $password= $this->request->all()["newPassword"];

            $rules=[
                'name' => ['required','min:2','max:80'],
                'email'=>['required','email'],
                'newPassword'=>['required_with:newPasswordRepeat','same:newPasswordRepeat',

            ],
            ];

            if(!is_null($password))
            {
                $rules['newPassword'] = ['regex:/[a-z]/','regex:/[A-Z]/','regex:/[0-9]/','regex:/[@$!+%*#?&]/','min:8'];

            }



        return $rules;
    }
    public function messages()
    {
        return [
        'name.required'=>'Kullanıcı adı boş geçilemez',
        'name.min'=>'Kullanıcı adı minimum 2 karakter olabilir.',
        'name.max'=>'Kullanıcı adı maksimum 80 karakter olabilir.',
        'email.required'=>'E-mail boş geçilemez',
        'email.email'=>'Geçerli bir e-mail giriniz',
        'same'=>'Yeni şifre ve yeni şifre tekrarı eşleşmelidir.',
        'required_with'=>'Yeni şifre ve yeni şifre tekrarı eşleşmelidir.',
        'newPassword.regex'=>'Şifre büyük küçük harf,rakamlar ve simgelerden oluşmalıdır.',
        'newPassword.min'=>'Şifre 8 karekterli olmalıdır.',




        ];
    }
}
