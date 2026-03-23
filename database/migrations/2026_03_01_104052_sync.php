<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('sync')) {
            Schema::create('sync', function (Blueprint $table): void {
                $table->bigIncrements('id');
                $table->uuid()->unique();
                $table->text('name');
                $table->integer('status');
                $table->text('option');
                $table->integer('attempts')->default(0);
                $table->dateTime('available_at')->default(now());
                $table->dateTime('finished_at')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('sync_details')) {
            Schema::create('sync_details', function (Blueprint $table): void {
                $table->bigIncrements('id');
                $table->uuid()->unique();
                $table->uuid('sync_uuid');
                $table->integer('user_id')->default(0);
                $table->integer('user_type')->default(0);
                $table->text('message')->nullable();
                $table->integer('status')->nullable();
                $table->text('details')->nullable();
                $table->dateTime('created_at')->default(now());
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sync');
        Schema::dropIfExists('sync_details');
    }
};
