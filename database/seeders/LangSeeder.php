<?php

namespace Database\Seeders;

use App\Models\Lang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lang::create([
            'name'=>'Türkçe',
            'order'=>1
        ]);
        Lang::create([
            'name'=>'English',
            'order'=>2
        ]);
        Lang::create([
            'name'=>'عربي',
            'order'=>3
        ]);
    }
}
