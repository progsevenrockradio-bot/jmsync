<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value', 'type', 'group'];

    /**
     * Get a setting value by key, with optional default.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $settings = static::all()->pluck('value', 'key');
        $value = $settings->get($key, $default);

        // Fall back to config/jmsync.php if not in DB
        if ($value === null) {
            $value = config("jmsync.{$key}", $default);
        }

        return $value;
    }

    /**
     * Set a setting value.
     */
    public static function set(string $key, mixed $value, string $type = 'text', string $group = 'general'): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type, 'group' => $group]
        );
    }

    /**
     * Get all settings as a key-value array, grouped.
     */
    public static function getAllGrouped(): array
    {
        return static::all()
            ->groupBy('group')
            ->map(fn($group) => $group->pluck('value', 'key'))
            ->toArray();
    }
}
