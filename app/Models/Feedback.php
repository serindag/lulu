<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    public function branch()
    {
        return $this->hasOne(Branch::class,'id','branch_id');
    }
}
