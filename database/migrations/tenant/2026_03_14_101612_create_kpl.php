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
            ImuisDataTableEnum::KPL->value,
            'staging_'.ImuisDataTableEnum::KPL->value,
        ];

        foreach ($tables as $tableName) {

            if (! Schema::hasTable($tableName)) {
                Schema::create($tableName, function (Blueprint $table) {
                    $table->bigInteger('id')->autoIncrement();
                    $table->integer('connect_id');
                    $table->string('hash');

                    $table->boolean('blok')->nullable();
                    $table->string('budh', 20)->nullable();
                    $table->string('kplublinl', 20)->nullable();
                    $table->integer('nivo')->nullable();
                    $table->integer('nr')->nullable(); // primary key
                    $table->string('omschr', 40)->nullable();
                    $table->string('selcd', 20)->nullable();
                    $table->string('zksl', 20)->nullable();
                });
            }
        }

        if (Schema::hasTable(ImuisDataTableEnum::KPL->value)) {
            Schema::table(ImuisDataTableEnum::KPL->value, function (Blueprint $table) {
                $table->index(['connect_id', 'hash'], 'idx_kpl_hash');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ImuisDataTableEnum::KPL->value);
        Schema::dropIfExists('staging_'.ImuisDataTableEnum::KPL->value);
    }
};
