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
        $tables = ['betcond', 'staging_betcond'];
        foreach ($tables as $tableName) {

            if (! Schema::hasTable($tableName)) {

                Schema::create($tableName, function (Blueprint $table) {
                    $table->bigInteger('id')->autoIncrement();
                    $table->integer('connect_id');
                    $table->string('hash');
                    $table->bigInteger('nr')->nullable(); // NUMERIC(3), primary key
                    $table->string('zksl', 40)->nullable(); // CHAR(40), verplicht
                    $table->decimal('bedrordkst', 19, 4)->nullable();      // MONEY
                    $table->decimal('bedrordkstincl', 19, 4)->nullable();  // MONEY
                    $table->decimal('bedrordkstmax', 19, 4)->nullable();   // MONEY
                    $table->decimal('bedrordkstmaxinc', 19, 4)->nullable(); // MONEY
                    $table->string('betcode', 1)->nullable();               // CHAR(1)
                    $table->boolean('blok')->nullable();                  // BOOLEAN
                    $table->string('gebrvoor', 1)->nullable();             // CHAR(1)
                    $table->unsignedInteger('grbordkst')->nullable();    // NUMERIC(8)
                    $table->unsignedInteger('grbordkstink')->nullable(); // NUMERIC(8)
                    $table->boolean('incasso')->nullable();              // BOOLEAN
                    $table->string('opm', 250)->nullable();              // CHAR(250)
                    $table->decimal('percbetkort', 10, 4)->nullable();   // NUMERIC(6)
                    $table->decimal('perckb', 10, 4)->nullable();        // NUMERIC(6)
                    $table->integer('vervdgn')->nullable();  // NUMERIC(3)
                });
            }
        }

        if (Schema::hasTable('betcond')) {
            Schema::table('betcond', function (Blueprint $table) {
                $table->index(['connect_id', 'hash'], 'idx_betcond_hash');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('betcond');
        Schema::dropIfExists('staging_betcond');
    }
};
