<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class AdminPopupRequest extends FormRequest
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
        
            $rules=[
               'branch_id' =>['required'],
               'category_id' =>['required'],
               'date_start'=>['required','date','after:now'],
               'date_end'=>['required','date','after:date_start'],
               
            ];
        
        return $rules;
    }
    public function messages()
    {
        return [
            'branch_id.required'=>'Lütfen Şube Seçiniz',
            'category_id.required'=>'Lütfen Kategori Seçiniz',
            'date_start.required'=>'Lütfen Başlangıç Tarihini Boş Bırakmayınız',
            'date_start.date'=>'Lütfen Tarih Giriniz',
            'date_start.after'=>'Lütfen Güncel Bir Tarih Seçiniz',
            'date_end.required'=>'Lütfen Bitiş Tarihini Boş Bırakmayınız',
            'date_end.date'=>'Lütfen Tarih Giriniz',
            'date_end'=>'Lütfen Başlangıç Tarihinden sonraki bir tarih giriniz'

        ];
    }
}
