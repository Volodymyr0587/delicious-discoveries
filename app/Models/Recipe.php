<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeOfCategory($query, $categoryId)
    {
        if ($categoryId) {
            return $query->where('category_id', $categoryId);
        }

        return $query;
    }
}
