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
        $tables = [ImuisDataTableEnum::ORDRG->value, 'staging_'.ImuisDataTableEnum::ORDRG->value];
        foreach ($tables as $tableName) {

            if (! Schema::hasTable($tableName)) {
                Schema::create($tableName, function (Blueprint $table) {
                    $table->bigInteger('id')->autoIncrement();
                    $table->integer('connect_id');
                    $table->string('hash');

                    $table->decimal('aant', 14, 4)->nullable();
                    $table->decimal('aantbackord', 14, 4)->nullable();
                    $table->decimal('aantgefact', 14, 4)->nullable();
                    $table->decimal('aantgelev', 14, 4)->nullable();
                    $table->decimal('aantpickbon', 14, 4)->nullable();
                    $table->decimal('aanttefact', 14, 4)->nullable();
                    $table->decimal('aanttelev', 14, 4)->nullable();
                    $table->string('afdrfact', 1)->nullable();
                    $table->string('afdrordbev', 1)->nullable();
                    $table->string('afdrpick', 1)->nullable();
                    $table->string('afdrverz', 1)->nullable();
                    $table->string('art', 20)->nullable();
                    $table->integer('artgrp')->nullable();
                    $table->decimal('bedr', 18, 2)->nullable();
                    $table->decimal('bedrincl', 18, 2)->nullable();
                    $table->integer('betaler')->nullable();
                    $table->boolean('blok')->nullable();
                    $table->string('btwsrt', 1)->nullable();
                    $table->integer('colli')->nullable();
                    $table->date('dat')->nullable();
                    $table->dateTime('datfact')->nullable();
                    $table->date('datlev')->nullable();
                    $table->string('datlevgewijz', 1)->nullable();
                    $table->dateTime('datordbev')->nullable();
                    $table->integer('deb')->nullable();
                    $table->string('eenh', 20)->nullable();
                    $table->integer('eenhprs')->nullable();
                    $table->integer('emballagerg')->nullable();
                    $table->integer('extordnr')->nullable();
                    $table->integer('fact')->nullable();
                    $table->string('gebrordbev', 1)->nullable();
                    $table->integer('inhoud')->nullable();
                    $table->string('istekstrg', 1)->nullable();
                    $table->integer('kdr')->nullable();
                    $table->decimal('kostpr', 18, 2)->nullable();
                    $table->integer('kpl')->nullable();
                    $table->string('levercorr', 1)->nullable();
                    $table->integer('mag')->nullable();
                    $table->string('omschr', 40)->nullable();
                    $table->text('opmext')->nullable();
                    $table->text('opmint')->nullable();
                    $table->integer('ordnr')->nullable();
                    $table->decimal('perckort', 6, 3)->nullable();
                    $table->string('perckortgewijz', 1)->nullable();
                    $table->decimal('perckortkort', 6, 3)->nullable();
                    $table->string('perckortkortwijz', 1)->nullable();
                    $table->decimal('prs', 18, 2)->nullable();
                    $table->string('prsgewijz', 1)->nullable();
                    $table->decimal('prsincl', 18, 2)->nullable();
                    $table->integer('rayon')->nullable();
                    $table->integer('rg')->nullable();
                    $table->integer('samenrg')->nullable();
                    $table->string('status', 1)->nullable();
                    $table->string('val', 3)->nullable();
                    $table->string('verkoper', 20)->nullable();
                    $table->decimal('volume', 14, 4)->nullable();
                });
            }
        }

        if (Schema::hasTable(ImuisDataTableEnum::ORDRG->value)) {
            Schema::table(ImuisDataTableEnum::ORDRG->value, function (Blueprint $table) {
                $table->index(['connect_id', 'hash'], 'idx_ordrg_hash');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ImuisDataTableEnum::ORDRG->value);
        Schema::dropIfExists('staging_'.ImuisDataTableEnum::ORDRG->value);
    }
};
