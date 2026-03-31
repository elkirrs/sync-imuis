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
        $tables = [ImuisDataTableEnum::SELCODE->value, 'staging_'.ImuisDataTableEnum::SELCODE->value];
        foreach ($tables as $tableName) {

            if (! Schema::hasTable($tableName)) {
                Schema::create($tableName, function (Blueprint $table) {
                    $table->bigInteger('id')->autoIncrement();
                    $table->integer('connect_id');
                    $table->string('hash');

                    $table->boolean('blok')->nullable();
                    $table->string('mailinglist', 50)->nullable();
                    $table->string('omschr', 40)->nullable();
                    $table->string('zksl', 20)->nullable(); // primary key
                });
            }
        }

        if (Schema::hasTable(ImuisDataTableEnum::SELCODE->value)) {
            Schema::table(ImuisDataTableEnum::SELCODE->value, function (Blueprint $table) {
                $table->index(['connect_id', 'hash'], 'idx_selcode_hash');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ImuisDataTableEnum::SELCODE->value);
        Schema::dropIfExists('staging_'.ImuisDataTableEnum::SELCODE->value);
    }
};
