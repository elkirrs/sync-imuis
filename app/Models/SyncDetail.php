<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class SyncDetail extends Model
{
    protected $table = 'sync_details';

    protected $primaryKey = 'uuid';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'uuid',
        'sync_uuid',
        'user_id',
        'user_type',
        'message',
        'status',
        'details',
        'created_at',
    ];

    protected $casts = [
        'uuid' => 'string',
        'sync_uuid' => 'string',
        'user_id' => 'integer',
        'user_type' => 'integer',
        'message' => 'string',
        'status' => 'integer',
        'details' => 'string',
        'created_at' => 'string',
    ];
}
