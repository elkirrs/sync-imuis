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
        $tables = ['koers', 'staging_koers'];
        foreach ($tables as $tableName) {

            if (! Schema::hasTable($tableName)) {
                Schema::create($tableName, function (Blueprint $table) {
                    $table->bigInteger('id')->autoIncrement();
                    $table->integer('connect_id');
                    $table->string('hash');

                    $table->boolean('blokprofiel')->nullable();
                    $table->date('datvan')->nullable();
                    $table->decimal('koers', 13, 6); // verplicht
                    $table->decimal('koersdefval', 13, 6); // verplicht
                    $table->bigInteger('nr')->nullable(); // primary key part
                    $table->string('val', 3)->nullable(); // primary key part
                });
            }
        }

        if (Schema::hasTable('koers')) {
            Schema::table('koers', function (Blueprint $table) {
                $table->index(['connect_id', 'hash'], 'idx_koers_hash');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('koers');
        Schema::dropIfExists('staging_koers');
    }
};
