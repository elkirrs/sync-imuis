<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Sync extends Model
{
    protected $table = 'sync';

    protected $primaryKey = 'uuid';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = true;

    protected $fillable = [
        'uuid',
        'name',
        'status',
        'option',
        'attempts',
        'available_at',
        'created_at',
        'updated_at',
        'finished_at',
    ];

    protected $casts = [
        'uuid' => 'string',
        'name' => 'string',
        'status' => 'integer',
        'option' => 'string',
        'attempts' => 'integer',
        'available_at' => 'string',
        'created_at' => 'string',
        'updated_at' => 'string',
        'finished_at' => 'string',
    ];
}
