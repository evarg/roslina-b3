<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Container extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function seeds()
    {
        return $this->belongsToMany(Seed::class);
    }    

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
