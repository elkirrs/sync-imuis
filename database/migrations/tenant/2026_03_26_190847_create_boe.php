<?php

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
            ImuisDataTableEnum::BOE->value,
            'staging_'.ImuisDataTableEnum::BOE->value,
        ];

        foreach ($tables as $tableName) {

            if (! Schema::hasTable($tableName)) {
                Schema::create($tableName, function (Blueprint $table) {
                    $table->bigInteger('id')->autoIncrement();
                    $table->integer('connect_id');
                    $table->string('hash');

                    $table->decimal('aant', 11, 2)->nullable();
                    $table->decimal('aant2', 11, 2)->nullable();
                    $table->decimal('aant3', 11, 2)->nullable();
                    $table->decimal('aantcre', 11, 2)->nullable();
                    $table->decimal('aantcre2', 11, 2)->nullable();
                    $table->decimal('aantcre3', 11, 2)->nullable();
                    $table->decimal('aantdeb', 11, 2)->nullable();
                    $table->decimal('aantdeb2', 11, 2)->nullable();
                    $table->decimal('aantdeb3', 11, 2)->nullable();
                    $table->decimal('bedr', 19, 4)->nullable();
                    $table->decimal('bedrbetkort', 19, 4)->nullable();
                    $table->decimal('bedrboek', 19, 4)->nullable();
                    $table->decimal('bedrboekval', 19, 4)->nullable();
                    $table->decimal('bedrbtw', 19, 4)->nullable();
                    $table->decimal('bedrcre', 19, 4)->nullable();
                    $table->decimal('bedrdeb', 19, 4)->nullable();
                    $table->decimal('bedrincl', 19, 4)->nullable();
                    $table->decimal('bedrkb', 19, 4)->nullable();
                    $table->decimal('bedrbtwval', 19, 4)->nullable();
                    $table->string('beoorcd')->nullable();
                    $table->string('boekstuk')->nullable();
                    $table->unsignedTinyInteger('btw')->nullable();
                    $table->unsignedBigInteger('cre')->nullable();
                    $table->unsignedInteger('dagb'); // PK
                    $table->date('dat');
                    $table->unsignedBigInteger('deb')->nullable();
                    $table->string('dossier')->nullable();
                    $table->string('fact')->nullable();
                    $table->unsignedBigInteger('grb');
                    $table->unsignedBigInteger('grprow')->nullable();
                    $table->boolean('isopboek')->nullable();
                    $table->unsignedInteger('jr'); // PK
                    $table->unsignedBigInteger('kdr')->nullable();
                    $table->decimal('koers', 13, 6)->nullable();
                    $table->unsignedBigInteger('kpl')->nullable();
                    $table->text('omschr')->nullable();
                    $table->text('opm')->nullable();
                    $table->unsignedTinyInteger('pn');
                    $table->string('prg')->nullable();
                    $table->unsignedBigInteger('rek')->nullable();
                    $table->unsignedBigInteger('rg');
                    $table->boolean('storno')->nullable();
                    $table->unsignedBigInteger('tegrek');
                    $table->string('val')->nullable();
                });
            }
        }

        if (Schema::hasTable(ImuisDataTableEnum::BOE->value)) {
            Schema::table(ImuisDataTableEnum::BOE->value, function (Blueprint $table) {
                $table->index(['connect_id', 'hash'], 'idx_boe_hash');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ImuisDataTableEnum::BOE->value);
        Schema::dropIfExists('staging_'.ImuisDataTableEnum::BOE->value);
    }
};
