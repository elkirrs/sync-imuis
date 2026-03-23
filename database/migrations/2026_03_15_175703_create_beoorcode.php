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
        $tables = ['beoorcode', 'staging_beoorcode'];
        foreach ($tables as $tableName) {

            if (! Schema::hasTable($tableName)) {
                Schema::create($tableName, function (Blueprint $table) {
                    $table->bigInteger('id')->autoIncrement();
                    $table->integer('connect_id');
                    $table->string('hash');

                    $table->boolean('blok')->nullable();
                    $table->boolean('blokprofiel')->nullable();
                    $table->string('hrow')->nullable();
                    $table->string('omschr', 40)->nullable();
                    $table->string('prg', 25)->nullable(); // niet toegankelijk
                    $table->string('zksl', 3)->nullable(); // primary key
                });
            }
        }

        if (Schema::hasTable('beoorcode')) {
            Schema::table('beoorcode', function (Blueprint $table) {
                $table->index(['connect_id', 'hash'], 'idx_beoorcode_hash');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beoorcode');
        Schema::dropIfExists('staging_beoorcode');
    }
};
