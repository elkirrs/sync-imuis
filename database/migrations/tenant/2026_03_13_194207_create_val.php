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
        $tables = ['val', 'staging_val'];
        foreach ($tables as $tableName) {

            if (! Schema::hasTable($tableName)) {
                Schema::create($tableName, function (Blueprint $table) {
                    $table->bigInteger('id')->autoIncrement();
                    $table->integer('connect_id');
                    $table->string('hash');

                    $table->string('zksl', 3)->nullable();
                    $table->decimal('aantkoers', 8, 2)->nullable();
                    $table->integer('afr')->nullable();
                    $table->boolean('blok')->nullable();
                    $table->boolean('blokprofiel')->nullable();
                    $table->integer('herwkst')->nullable();
                    $table->integer('herwopbr')->nullable();
                    $table->string('iso', 3)->nullable();
                    $table->integer('jrverv')->nullable();
                    $table->decimal('koers', 13, 6)->nullable();
                    $table->decimal('koersdefval', 13, 6)->nullable();
                    $table->integer('krsverskst')->nullable();
                    $table->integer('krsversopbr')->nullable();
                    $table->string('omschr', 20)->nullable();
                    $table->string('teken', 3)->nullable();
                });
            }
        }

        if (Schema::hasTable('val')) {
            Schema::table('val', function (Blueprint $table) {
                $table->index(['connect_id', 'hash'], 'idx_val_hash');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('val');
        Schema::dropIfExists('staging_val');
    }
};
