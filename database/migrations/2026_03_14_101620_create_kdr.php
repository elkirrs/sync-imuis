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
        $tables = ['kdr', 'staging_kdr'];
        foreach ($tables as $tableName) {

            if (! Schema::hasTable($tableName)) {
                Schema::create($tableName, function (Blueprint $table) {
                    $table->bigInteger('id')->autoIncrement();
                    $table->integer('connect_id');
                    $table->string('hash');

                    $table->boolean('blok')->nullable();
                    $table->date('dataanvang')->nullable();
                    $table->date('datgereed')->nullable();
                    $table->integer('deb')->nullable();
                    $table->string('kdrublinl', 20)->nullable();
                    $table->string('medewdec', 20)->nullable();
                    $table->integer('nivo')->nullable();
                    $table->integer('nr')->nullable(); // primary key
                    $table->string('omschr', 40)->nullable();
                    $table->string('opm', 250)->nullable();
                    $table->string('selcd', 20)->nullable();
                    $table->string('vrijveld1', 40)->nullable();
                    $table->string('vrijveld2', 40)->nullable();
                    $table->string('vrijveld3', 20)->nullable();
                    $table->string('vrijveld4', 20)->nullable();
                    $table->string('vrijveld5', 20)->nullable();
                    $table->string('zksl', 20)->nullable();
                });
            }
        }

        if (Schema::hasTable('kdr')) {
            Schema::table('kdr', function (Blueprint $table) {
                $table->index(['connect_id', 'hash'], 'idx_kdr_hash');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kdr');
        Schema::dropIfExists('staging_kdr');
    }
};
