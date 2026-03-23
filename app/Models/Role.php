<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Role extends Model
{
    protected $table = 'roles';

    protected $primaryKey = 'id';

    protected $fillable = [
        'type',
        'name',
    ];
}
