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
        $tables = [
            ImuisDataTableEnum::ARTGRP->value,
            'staging_'.ImuisDataTableEnum::ARTGRP->value,
        ];

        foreach ($tables as $tableName) {

            if (! Schema::hasTable($tableName)) {
                Schema::create($tableName, function (Blueprint $table) {

                    $table->bigInteger('id')->autoIncrement();
                    $table->integer('connect_id');
                    $table->string('hash');

                    $table->integer('nr')->nullable();
                    $table->boolean('blok')->nullable();
                    $table->integer('grbdivvrd')->nullable();
                    $table->integer('grbherw')->nullable();
                    $table->integer('grbinknvrdreg')->nullable();
                    $table->integer('grbkostpr')->nullable();
                    $table->integer('grbntogf')->nullable();
                    $table->integer('grbomz')->nullable();
                    $table->integer('grbomzbineu')->nullable();
                    $table->integer('grbomzbuiEU')->nullable();
                    $table->integer('grbpvs')->nullable();
                    $table->integer('grbrntogf')->nullable();
                    $table->integer('grbvrd')->nullable();
                    $table->string('omschr', 40)->nullable();
                    $table->string('zksl', 20)->nullable();

                });
            }
        }

        if (Schema::hasTable(ImuisDataTableEnum::ARTGRP->value)) {
            Schema::table(ImuisDataTableEnum::ARTGRP->value, function (Blueprint $table) {
                $table->index(['connect_id', 'hash'], 'idx_artgrp_hash');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ImuisDataTableEnum::ARTGRP->value);
        Schema::dropIfExists('staging_'.ImuisDataTableEnum::ARTGRP->value);
    }
};
