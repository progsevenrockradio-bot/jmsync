<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'excerpt', 'description', 'featured_image',
        'gallery', 'category_id', 'client', 'project_url',
        'completed_at', 'featured', 'published', 'order', 'meta',
    ];

    protected $casts = [
        'gallery'      => 'array',
        'meta'         => 'array',
        'featured'     => 'boolean',
        'published'    => 'boolean',
        'completed_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopePublished(\Illuminate\Database\Eloquent\Builder $query)
    {
        return $query->where('published', true);
    }

    public function scopeFeatured(\Illuminate\Database\Eloquent\Builder $query)
    {
        return $query->where('featured', true);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }
}
