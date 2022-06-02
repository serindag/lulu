<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    
    public function branch()
    {
        return $this->hasOne(Branch::class,'id','branch_id');
    }
    public function category()
    {
        return $this->hasOne(Category::class,'id','category_id');
    }
}
