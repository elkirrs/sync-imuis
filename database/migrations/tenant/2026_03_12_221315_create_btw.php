<?php

declare(strict_types=1);

use App\Shared\Enums\ImuisDataTableEnum;
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
        $tables = [ImuisDataTableEnum::BTW->value, 'staging_'.ImuisDataTableEnum::BTW->value];
        foreach ($tables as $tableName) {

            if (! Schema::hasTable($tableName)) {

                Schema::create($tableName, function (Blueprint $table) {
                    $table->bigInteger('id')->autoIncrement();
                    $table->integer('connect_id');
                    $table->string('hash');
                    $table->integer('nr')->nullable();
                    $table->string('zksl', 20);
                    $table->string('blok', 1)->nullable();
                    $table->string('blokcre', 1)->nullable();
                    $table->string('blokdeb', 1)->nullable();
                    $table->boolean('blokprofiel')->nullable();
                    $table->string('btwber', 1)->nullable();
                    $table->string('btwict', 1)->nullable();
                    $table->string('btwpl', 1)->nullable();
                    $table->date('datingang')->nullable();
                    $table->string('formgrp', 2)->nullable();
                    $table->integer('grb')->nullable();
                    $table->boolean('loonwerk')->nullable();
                    $table->string('omschr', 40)->nullable();
                    $table->string('opm', 250)->nullable();
                    $table->decimal('perc', 10, 2)->nullable();
                    $table->decimal('percnw', 10, 2)->nullable();
                    $table->string('selcd', 20)->nullable();
                    $table->boolean('waarschcre')->nullable();
                    $table->boolean('waarschdeb')->nullable();
                });
            }
        }

        if (Schema::hasTable(ImuisDataTableEnum::BTW->value)) {
            Schema::table(ImuisDataTableEnum::BTW->value, function (Blueprint $table) {
                $table->index(['connect_id', 'hash'], 'idx_btw_hash');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ImuisDataTableEnum::BTW->value);
        Schema::dropIfExists('staging_'.ImuisDataTableEnum::BTW->value);
    }
};
