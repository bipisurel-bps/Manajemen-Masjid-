<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'type', 'label', 'group'];

    /**
     * Get a setting value by key, with optional default.
     */
    public static function get(string $key, $default = null): ?string
    {
        return Cache::rememberForever("setting.{$key}", function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Set a setting value and bust the cache.
     */
    public static function set(string $key, ?string $value, ?string $label = null, ?string $group = 'general'): void
    {
        static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'label' => $label ?? ucwords(str_replace('_', ' ', $key)),
                'group' => $group ?? 'general',
            ]
        );
        Cache::forget("setting.{$key}");
    }

    /**
     * Get all settings as a collection.
     */
    public static function allCached(): array
    {
        return Cache::rememberForever('settings.all', function () {
            return static::all()->pluck('value', 'key')->toArray();
        });
    }

    /**
     * Bust all setting caches.
     */
    public static function bustCache(): void
    {
        static::all()->each(fn ($s) => Cache::forget("setting.{$s->key}"));
        Cache::forget('settings.all');
    }

    protected static function booted(): void
    {
        static::saved(fn () => static::bustCache());
        static::deleted(fn () => static::bustCache());
    }
}
