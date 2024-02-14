<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Place extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'desc'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function containers(): HasMany
    {
        return $this->hasMany(Container::class);
    }
}
