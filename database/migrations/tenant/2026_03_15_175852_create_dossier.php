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
        $tables = ['dossier', 'staging_dossier'];
        foreach ($tables as $tableName) {

            if (! Schema::hasTable($tableName)) {
                Schema::create($tableName, function (Blueprint $table) {
                    $table->bigInteger('id')->autoIncrement();
                    $table->integer('connect_id');
                    $table->string('hash');

                    $table->boolean('blok')->nullable();
                    $table->boolean('blokhandm')->nullable();
                    $table->boolean('blokprofiel')->nullable();
                    $table->date('datbegin')->nullable();
                    $table->date('dateind')->nullable();
                    $table->integer('kdr')->nullable();
                    $table->integer('kpl')->nullable();
                    $table->string('locatie', 250)->nullable();
                    $table->string('omschr', 40)->nullable();
                    $table->string('opm', 250)->nullable();
                    $table->string('wkroptie', 1)->nullable();
                    $table->string('zksl', 20)->nullable(); // primary key
                });
            }
        }

        if (Schema::hasTable('dossier')) {
            Schema::table('dossier', function (Blueprint $table) {
                $table->index(['connect_id', 'hash'], 'idx_dossier_hash');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dossier');
        Schema::dropIfExists('staging_dossier');
    }
};
