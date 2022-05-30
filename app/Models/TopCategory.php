<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopCategory extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->hasMany(Category::class, 'topcategory_id', 'id');

        
    }
    
}
