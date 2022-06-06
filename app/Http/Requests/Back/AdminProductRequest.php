<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class AdminProductRequest extends FormRequest
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
            
            'price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'image' => ['image', 'max:3072', 'mimes:png,jpg,jpeg'],

        ];
        if (!isset($this->request->all()["id"])) {
            $rules['image'] = ['required'];
        }

        return $rules;
    }
    public function messages()
    {
        return [
           
            'price.required' => 'Fiyat Boş Geçilmez',
            'price.regex' => 'Fiyat Numaralardan Oluşmalıdır.',
            'image.image' => 'Lütfen resim dosyası giriniz.',
            'image.required' => 'Resim Boş Geçilemez',
            'image.max' => '3 MB den büyük resim yüklenemez',
            'image.mimes' => 'Sadece png,jpg ve jpeg Dosyaları Yüklenebilir',

        ];
    }
}
