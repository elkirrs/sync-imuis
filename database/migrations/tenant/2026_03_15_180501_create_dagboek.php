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
        $tables = ['dagboek', 'staging_dagboek'];
        foreach ($tables as $tableName) {

            if (! Schema::hasTable($tableName)) {
                Schema::create($tableName, function (Blueprint $table) {
                    $table->bigInteger('id')->autoIncrement();
                    $table->integer('connect_id');
                    $table->string('hash');

                    $table->boolean('blok')->nullable();
                    $table->boolean('blokcre')->nullable();
                    $table->boolean('blokdeb')->nullable();
                    $table->boolean('blokgrb')->nullable();
                    $table->boolean('blokhandm')->nullable();
                    $table->boolean('blokprofiel')->nullable();
                    $table->string('boekstuk', 20)->nullable();
                    $table->decimal('eindsaldo', 15, 2)->nullable();
                    $table->string('fact', 19)->nullable();
                    $table->string('gebrjrboekstuk', 1)->nullable();
                    $table->string('gebrjrfact', 1)->nullable();
                    $table->integer('kdr')->nullable();
                    $table->integer('kpl')->nullable();
                    $table->integer('nr')->nullable(); // primary key
                    $table->string('omschr', 40)->nullable();
                    $table->string('omschrboekstuk', 20)->nullable();
                    $table->string('omschrcre', 20)->nullable();
                    $table->string('omschrcreaant', 20)->nullable();
                    $table->string('omschrcreaant2', 20)->nullable();
                    $table->string('omschrcreaant3', 20)->nullable();
                    $table->string('omschrdeb', 20)->nullable();
                    $table->string('omschrdebaant', 20)->nullable();
                    $table->string('omschrdebaant2', 20)->nullable();
                    $table->string('omschrdebaant3', 20)->nullable();
                    $table->string('omschrfact', 20)->nullable();
                    $table->string('rekvoork', 1)->nullable();
                    $table->boolean('saldouitgrb')->nullable();
                    $table->string('srt', 1)->nullable();
                    $table->integer('tegrek')->nullable();
                    $table->string('zksl', 20)->nullable();
                });
            }
        }

        if (Schema::hasTable('dagboek')) {
            Schema::table('dagboek', function (Blueprint $table) {
                $table->index(['connect_id', 'hash'], 'idx_dagboek_hash');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dagboek');
        Schema::dropIfExists('staging_dagboek');
    }
};
