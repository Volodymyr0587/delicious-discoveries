<?php

namespace App\Models;

use App\Traits\Viewable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Recipe extends Model
{
    use HasFactory, Viewable;

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
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

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function isLikedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function scopeOfCategory($query, $categoryId)
    {
        return $categoryId ? $query->where('category_id', $categoryId) : $query;
    }

    public function scopeOfUser($query, $userId)
    {
        return $userId ? $query->where('user_id', $userId) : $query;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function next(): ?Recipe
    {
        return self::where('id', '>', $this->id)
            ->orderBy('id')
            ->first();
    }

    public function previous(): ?Recipe
    {
        return self::where('id', '<', $this->id)
            ->orderByDesc('id')
            ->first();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($recipe) {

            $slug = Str::slug($recipe->name);

            $count = static::where('slug', 'LIKE', "{$slug}%")->count();

            $recipe->slug = $count
                ? "{$slug}-{$count}"
                : $slug;

        });

        static::updating(function ($recipe) {

            if ($recipe->isDirty('name')) {

                $recipe->slug = Str::slug($recipe->name);

            }

        });

        static::deleting(function ($recipe) {
            if ($recipe->image) {
                Storage::disk('public')->delete($recipe->image);
            }
            $recipe->views()->delete();
        });
    }
}
