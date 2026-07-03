<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'type', 'description', 'order'];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function scopePortfolio(\Illuminate\Database\Eloquent\Builder $query)
    {
        return $query->where('type', 'portfolio')->orderBy('order');
    }

    public function scopeBlog(\Illuminate\Database\Eloquent\Builder $query)
    {
        return $query->where('type', 'blog')->orderBy('order');
    }
}
