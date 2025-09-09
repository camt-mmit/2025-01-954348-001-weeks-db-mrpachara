<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $fillable = ['code', 'name', 'price', 'description'];

    function shops(): BelongsToMany
    {
        return $this->belongsToMany(Shop::class)->withTimestamps();;
    }
}
