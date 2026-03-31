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
        $tables = [ImuisDataTableEnum::GRBMUT->value, 'staging_'.ImuisDataTableEnum::GRBMUT->value];
        foreach ($tables as $tableName) {

            if (! Schema::hasTable($tableName)) {
                Schema::create($tableName, function (Blueprint $table) {
                    $table->bigInteger('id')->autoIncrement();
                    $table->integer('connect_id');
                    $table->string('hash');

                    $table->bigInteger('aant')->nullable();
                    $table->bigInteger('aant2')->nullable();
                    $table->bigInteger('aant3')->nullable();
                    $table->string('afgeletterd', 1)->nullable();
                    $table->string('aflcd', 10)->nullable();
                    $table->decimal('bedr', 18, 2)->nullable();
                    $table->decimal('bedrval', 18, 2)->nullable();
                    $table->string('boekstuk', 20)->nullable();
                    $table->bigInteger('cre')->nullable();
                    $table->bigInteger('dagb')->nullable(); // primary key
                    $table->date('dat')->nullable();
                    $table->bigInteger('deb')->nullable();
                    $table->string('debcre', 1)->nullable();
                    $table->string('dossier', 20)->nullable();
                    $table->bigInteger('fact')->nullable();
                    $table->bigInteger('grb')->nullable();
                    $table->bigInteger('jr')->nullable(); // primary key
                    $table->string('jraansl', 1)->nullable();
                    $table->bigInteger('kdr')->nullable();
                    $table->bigInteger('kpl')->nullable();
                    $table->bigInteger('pn')->nullable(); // primary key
                    $table->bigInteger('rg')->nullable(); // primary key
                    $table->string('srt', 1)->nullable(); // primary key
                    $table->bigInteger('tegrek')->nullable();
                    $table->bigInteger('transrow')->nullable();
                    $table->string('val', 3)->nullable();
                });
            }
        }

        if (Schema::hasTable(ImuisDataTableEnum::GRBMUT->value)) {
            Schema::table(ImuisDataTableEnum::GRBMUT->value, function (Blueprint $table) {
                $table->index(['connect_id', 'hash'], 'idx_grbmut_hash');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ImuisDataTableEnum::GRBMUT->value);
        Schema::dropIfExists('staging_'.ImuisDataTableEnum::GRBMUT->value);
    }
};
