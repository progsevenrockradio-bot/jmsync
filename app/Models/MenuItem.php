<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuItem extends Model
{
    protected $fillable = [
        'label', 'url', 'route_name', 'menu_location',
        'parent_id', 'order', 'open_new_tab', 'css_class',
    ];

    protected $casts = [
        'open_new_tab' => 'boolean',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('order');
    }

    public function scopeLocation(\Illuminate\Database\Eloquent\Builder $query, string $location)
    {
        return $query->where('menu_location', $location)
                     ->whereNull('parent_id')
                     ->orderBy('order');
    }

    /**
     * Resolve the URL for this menu item.
     */
    public function getHrefAttribute(): string
    {
        if ($this->route_name) {
            try {
                return route($this->route_name);
            } catch (\Exception $e) {
                return $this->url ?? '#';
            }
        }
        return $this->url ?? '#';
    }

    /**
     * Return full menu tree for a given location.
     */
    public static function menuTree(string $location): \Illuminate\Support\Collection
    {
        return static::with('children')
            ->location($location)
            ->get()
            ->map(fn($item) => [
                'id'          => $item->id,
                'label'       => $item->label,
                'href'        => $item->href,
                'open_new_tab'=> $item->open_new_tab,
                'css_class'   => $item->css_class,
                'children'    => $item->children->map(fn($child) => [
                    'id'          => $child->id,
                    'label'       => $child->label,
                    'href'        => $child->href,
                    'open_new_tab'=> $child->open_new_tab,
                    'css_class'   => $child->css_class,
                    'children'    => [],
                ])->toArray(),
            ]);
    }
}
