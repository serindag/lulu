<?php

namespace App\Http\Requests\Branch;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
           
            'image' => ['image', 'max:1024', 'mimes:png,jpg,jpeg'],

        ];

        if (!isset($this->request->all()["id"])) {

            
                $rules['image'] = ['required'];
            
        }


        return $rules;
    }
    public function messages()
    {
        return [
            
            'image.image' => 'Lütfen resim dosyası giriniz.',
            'image.required' => 'Resim Boş Geçilemez',
            'image.max' => '1 MB den büyük resim yüklenemez',
            'image.mimes' => 'Sadece png,jpg ve jpeg Dosyaları Yüklenebilir',



        ];
    }
}
