<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperLeague
 */
class League extends Model
{
    use HasFactory;

    public function competitions(): HasMany
    {
        return $this->hasMany(Competition::class);
    }
}
