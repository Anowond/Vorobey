<?php

namespace App\Models;

use App\Enums\videostatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Video extends Model
{
    use HasFactory;

    // Chargement des relations (Eager Loading)
    protected $with = ['tags'];
    // Autorisation du mass assignment sur les champs
    protected $fillable = [
        'title','slug', 'url', 'description', 'thumbnail','status','tags',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }


}
