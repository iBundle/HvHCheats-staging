<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Game extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'version',
        'is_active',
        'release_date',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'release_date' => 'date',
        'sort_order' => 'integer',
    ];

    protected $attributes = [
        'is_active' => true,
        'sort_order' => 0,
    ];

    // Relationships
    public function cheats(): HasMany
    {
        return $this->hasMany(Cheat::class);
    }

    // Scopes
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }


    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Helper methods
    public function getCheatsCount(): int
    {
        return $this->cheats()->count();
    }
}