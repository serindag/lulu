<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class AdminBranchRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'min:2', 'max:80'],
            'branch_group_id' => ['required'],
            'city' => ['required', 'min:2', 'max:80'],
            'address' => ['required', 'min:2'],
            'telephone' => ['required', 'numeric'],
            'fax' => ['required', 'numeric'],
            'email' => ['required', 'email'],
            'service_start' => ['required', ],
            'service_end' => ['required', 'after:service_start'],

        ];
        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => 'Şube Adı Boş Geçilmez',
            'name.min' => 'Şube Adı 2 Karakterden Az Olamaz',
            'name.min' => 'Şube Adı 80 Karakterden Fazla Olamaz',
            'branch_group_id.required' => 'Lütfen Grup Adı Seçiniz.',
            'city.required' => 'Şehir Adı Boş Geçilmez',
            'city.min' => 'Şehir Adı 2 Karakterden Az Olamaz',
            'city.max' => 'Şehir Adı 80 Karakterden Fazla Olamaz',
            'address.required' => 'Adres Adı Boş Geçilmez',
            'address.min' => 'Adres 2 Karakterden Az Olamaz',
            'telephone.required' => 'Telefon Boş Geçilmez',
            'telephone.numeric' => 'Telefon Numaralardan Oluşmalıdır.',
            'fax.required' => 'Fax Boş Geçilmez',
            'fax.numeric' => 'Fax Numaralardan Oluşmalıdır.',
            'email.required' => 'E mail Boş Geçilmez',
            'email.email' => 'Lürfen Email Adresini Doğru Giriniz.',
            'service_start.required' => 'Lütfen Başlangıç Tarihini Boş Bırakmayınız',
          
            'service_end.required' => 'Lütfen Bitiş Tarihini Boş Bırakmayınız',
            'service_end.after' => 'Lütfen Başlangıç Tarihinden sonraki bir tarih giriniz',

        ];
    }
}
