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
            ImuisDataTableEnum::ART->value,
            'staging_'.ImuisDataTableEnum::ART->value,
        ];

        foreach ($tables as $tableName) {

            if (! Schema::hasTable($tableName)) {
                Schema::create($tableName, function (Blueprint $table) {

                    $table->bigInteger('id')->autoIncrement();
                    $table->integer('connect_id');
                    $table->string('hash');
                    $table->decimal('aantbinnen', 14, 4)->nullable();
                    $table->integer('aantcolli')->nullable();
                    $table->decimal('aantdoos', 14, 4)->nullable();
                    $table->string('actafb', 20)->nullable();
                    $table->string('afbeeldingart', 20)->nullable();
                    $table->string('afbeeldingzksl', 40)->nullable();
                    $table->string('afdrfact', 1)->nullable();
                    $table->string('afdrofferte', 1)->nullable();
                    $table->string('afdrordbev', 1)->nullable();
                    $table->string('afdrpick', 1)->nullable();
                    $table->string('afdrverz', 1)->nullable();
                    $table->string('afraant', 1)->nullable();
                    $table->string('afrprs', 4)->nullable();
                    $table->string('afrprsincl', 4)->nullable();
                    $table->integer('artgrp')->nullable();
                    $table->string('artmld', 8)->nullable();
                    $table->string('artsamcode', 1)->nullable();
                    $table->string('bestel', 20)->nullable();
                    $table->boolean('blok')->nullable();
                    $table->boolean('blokdecl')->nullable();
                    $table->boolean('blokvrk')->nullable();
                    $table->boolean('blokwebshop')->nullable();
                    $table->decimal('breedtebruto', 14, 4)->nullable();
                    $table->decimal('breedtedoos', 14, 4)->nullable();
                    $table->decimal('breedtenetto', 14, 4)->nullable();
                    $table->string('btw', 1)->nullable();
                    $table->string('cat', 20)->nullable();
                    $table->string('categorie', 1)->nullable();
                    $table->string('dataangem')->nullable();
                    $table->decimal('dikte', 14, 4)->nullable();
                    $table->decimal('doorsnee', 14, 4)->nullable();
                    $table->string('ean', 20)->nullable();
                    $table->string('eenhink', 20)->nullable();
                    $table->integer('eenhinkprs')->nullable();
                    $table->integer('eenhprs')->nullable();
                    $table->string('eenhverk', 20)->nullable();
                    $table->string('emballageart', 20)->nullable();
                    $table->string('eol', 1)->nullable();
                    $table->decimal('gewichtbruto', 14, 4)->nullable();
                    $table->decimal('gewichtdoos', 14, 4)->nullable();
                    $table->decimal('gewichtnetto', 14, 4)->nullable();
                    $table->string('gidsartikel', 50)->nullable();
                    $table->decimal('hoogtebruto', 14, 4)->nullable();
                    $table->decimal('hoogtedoos', 14, 4)->nullable();
                    $table->decimal('hoogtenetto', 14, 4)->nullable();
                    $table->decimal('inhverk', 9, 4)->nullable();
                    $table->decimal('inkpr', 18, 4)->nullable();
                    $table->string('isemballage', 1)->nullable();
                    $table->string('istekstrg', 1)->nullable();
                    $table->integer('kdr')->nullable();
                    $table->decimal('kostpr', 18, 4)->nullable();
                    $table->decimal('kostprherw', 18, 4)->nullable();
                    $table->string('kostprherwjn', 1)->nullable();
                    $table->integer('kpl')->nullable();
                    $table->decimal('lengtebruto', 14, 4)->nullable();
                    $table->decimal('lengtedoos', 14, 4)->nullable();
                    $table->decimal('lengtenetto', 14, 4)->nullable();
                    $table->string('levsrt', 1)->nullable();
                    $table->integer('levtijd')->nullable();
                    $table->integer('mag')->nullable();
                    $table->decimal('minverkoop', 14, 4)->nullable();
                    $table->string('nr', 20)->nullable();
                    $table->string('omschr', 40)->nullable();
                    $table->text('opmext')->nullable();
                    $table->text('opmint')->nullable();
                    $table->string('seriegebrhbdat', 1)->nullable();
                    $table->string('serieinksrt', 1)->nullable();
                    $table->integer('serieinktijd')->nullable();
                    $table->string('serieregink', 1)->nullable();
                    $table->string('serieregvrk', 1)->nullable();
                    $table->string('serieuniek', 1)->nullable();
                    $table->string('serieverksrt', 1)->nullable();
                    $table->integer('serieverktijd')->nullable();
                    $table->boolean('vasteprs')->nullable();
                    $table->decimal('verkpr', 18, 4)->nullable();
                    $table->decimal('verkprincl', 18, 4)->nullable();
                    $table->decimal('verpakeenh', 14, 4)->nullable();
                    $table->decimal('verpaktper', 14, 4)->nullable();
                    $table->decimal('volumebruto', 14, 4)->nullable();
                    $table->decimal('volumedoos', 14, 4)->nullable();
                    $table->decimal('volumenetto', 14, 4)->nullable();
                    $table->string('vrdreg', 1)->nullable();
                    $table->string('vrijveld1', 40)->nullable();
                    $table->string('vrijveld2', 40)->nullable();
                    $table->string('vrijveld3', 20)->nullable();
                    $table->string('vrijveld4', 20)->nullable();
                    $table->string('vrijveld5', 20)->nullable();
                    $table->string('vrijveld6', 100)->nullable();
                    $table->string('vrijveld7', 50)->nullable();
                    $table->string('vrijveld8', 20)->nullable();
                    $table->string('vrijveld9', 20)->nullable();
                    $table->string('vrijveld10', 20)->nullable();
                    $table->string('zksl', 20)->nullable();
                });
            }
        }

        if (Schema::hasTable(ImuisDataTableEnum::ART->value)) {
            Schema::table(ImuisDataTableEnum::ART->value, function (Blueprint $table) {
                $table->index(['connect_id', 'hash'], 'idx_art_hash');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ImuisDataTableEnum::ART->value);
        Schema::dropIfExists('staging_'.ImuisDataTableEnum::ART->value);
    }
};
