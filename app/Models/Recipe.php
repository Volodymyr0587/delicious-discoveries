<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'recipe_name',
        'ingredients',
        'description',
        'image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeOfCategory($query, $categoryId)
    {
        if ($categoryId) {
            return $query->where('category_id', $categoryId);
        }

        return $query;
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($recipe) {
            if ($recipe->image) {
                Storage::disk('public')->delete($recipe->image);
            }
        });
    }
}
