<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Connection extends Model
{
    protected $table = 'connections';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'type',
        'options',
        'description',
        'is_active',
    ];

    protected $casts = [
        'name' => 'string',
        'type' => 'string',
        'options' => 'string',
        'description' => 'string',
        'is_active' => 'boolean',
    ];
}
