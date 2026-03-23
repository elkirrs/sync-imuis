<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Role::query()->insert([
            ['name' => 'Administrator', 'type' => 'admin'],
            ['name' => 'User', 'type' => 'user'],
        ]);

        User::query()->createOrFirst([
            'name' => 'admin.user',
            'email' => 'example@email.com',
            'password' => Hash::make('123456789'),
            'role_id' => 1,
        ]);
    }
}
