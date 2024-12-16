<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'category_id', 'cousine_id', 'image', 'author_id', 'servings_count', 'likes_count', 'dislikes_count'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function cousine()
    {
        return $this->belongsTo(Cousine::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_recipe')->withPivot('quantity', 'unit');
    }

    public function instructions()
    {
        return $this->hasMany(Instruction::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'favorites')
            ->withTimestamps();
    }

    public function incrementLikes()
    {
        $this->increment('likes_count');
    }

    public function decrementLikes()
    {
        if ($this->likes_count > 0) {
            $this->decrement('likes_count');
        }
    }

    public function incrementDislikes()
    {
        $this->increment('dislikes_count');
    }

    public function decrementDislikes()
    {
        if ($this->dislikes_count > 0) {
            $this->decrement('dislikes_count');
        }
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
