<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function scopeRoot($query)
    {
        $query->whereNull('parent_id');
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('order', 'ASC');
    }
}
