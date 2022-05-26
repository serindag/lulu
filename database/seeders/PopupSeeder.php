<?php

namespace Database\Seeders;

use App\Models\Popup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PopupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Popup::create([
            'description'=>'türkçe',
            'lang_id'=>1
        ]);
        Popup::create([
            'description'=>'İngilizce',
            'lang_id'=>2
        ]);
        Popup::create([
            'description'=>'Arapça',
            'lang_id'=>3
        ]);

    }
}
