<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlockedEntity extends Model
{
    protected $table = 'blocked_entities';

    protected $fillable = [
        'type',
        'value',
    ];
}
