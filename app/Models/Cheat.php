<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Cheat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'love',
        'downloads',
        'image',
        'cheat',
        'game_id',
        'cheat_status_id',
        'created_by',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    // Relationships
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Scopes
    public function scopeForGame(Builder $query, string $gameSlug): Builder
    {
        return $query->whereHas('game', fn($q) => $q->where('slug', $gameSlug));
    }

    public function scopeByStatus(Builder $query, string $statusSlug): Builder
    {
        return $query->whereHas('cheatStatus', fn($q) => $q->where('slug', $statusSlug));
    }

    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%");
        });
    }

    // Accessors
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getMetaTitleAttribute($value): string
    {
        return $value ?: $this->name . ' - Чит для ' . $this->game->name;
    }

    public function getMetaDescriptionAttribute($value): string
    {
        return $value ?: Str::limit($this->description, 160);
    }
}
