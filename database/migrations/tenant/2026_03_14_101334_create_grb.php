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
        $tables = [ImuisDataTableEnum::GRB->value, 'staging_'.ImuisDataTableEnum::GRB->value];
        foreach ($tables as $tableName) {

            if (! Schema::hasTable($tableName)) {
                Schema::create($tableName, function (Blueprint $table) {
                    $table->bigInteger('id')->autoIncrement();
                    $table->integer('connect_id');
                    $table->string('hash');

                    $table->boolean('aantadm')->nullable();
                    $table->string('act', 1)->nullable();
                    $table->integer('actnr')->nullable();
                    $table->string('acttype', 1)->nullable();
                    $table->decimal('actvanaf', 18, 4)->nullable();
                    $table->string('afschrmeth', 1)->nullable();
                    $table->string('apbl', 1)->nullable();
                    $table->string('beoorcd', 3)->nullable();
                    $table->boolean('blok')->nullable();
                    $table->integer('btw')->nullable();
                    $table->string('dc', 1)->nullable();
                    $table->string('dossier', 20)->nullable();
                    $table->boolean('dossverpl')->nullable();
                    $table->integer('grbafschrbalans')->nullable();
                    $table->integer('grbafschrbalcum')->nullable();
                    $table->integer('grbafschrvw')->nullable();
                    $table->integer('grbdesinv')->nullable();
                    $table->integer('grbdesinvafs')->nullable();
                    $table->integer('grbdesinvverlies')->nullable();
                    $table->integer('grbdesinvwinst')->nullable();
                    $table->integer('grbherinvres')->nullable();
                    $table->integer('grbopbrdesinv')->nullable();
                    $table->boolean('herw')->nullable();
                    $table->string('isafl', 1)->nullable();
                    $table->string('isaflrapportage', 1)->nullable();
                    $table->string('isprive', 1)->nullable();
                    $table->string('isrc', 1)->nullable();
                    $table->integer('kdr')->nullable();
                    $table->string('kdrverpl', 1)->nullable();
                    $table->integer('kpl')->nullable();
                    $table->string('kplverpl', 1)->nullable();
                    $table->integer('looptijd')->nullable();
                    $table->string('mapping', 25)->nullable();
                    $table->integer('nivo')->nullable();
                    $table->integer('nr')->nullable(); // primary key
                    $table->string('omschr', 40)->nullable();
                    $table->string('opm', 250)->nullable();
                    $table->integer('rcadm')->nullable();
                    $table->integer('rctegrek')->nullable();
                    $table->string('restgvherinv', 1)->nullable();
                    $table->string('selcd', 20)->nullable();
                    $table->string('rgs', 15)->nullable();
                    $table->string('sluitrek', 1)->nullable();
                    $table->string('specgrbmut', 1)->nullable();
                    $table->string('specprive', 1)->nullable();
                    $table->integer('stamrechtgrbap')->nullable();
                    $table->integer('stamrechtgrbbl')->nullable();
                    $table->string('stamrechtjn', 1)->nullable();
                    $table->integer('stamrechtjr')->nullable();
                    $table->integer('stamrechtjr2')->nullable();
                    $table->decimal('stamrechtperc', 6, 2)->nullable();
                    $table->integer('stamrechtpn')->nullable();
                    $table->integer('stamrechtpn2')->nullable();
                    $table->string('stamrechtsoort', 1)->nullable();
                    $table->string('stamrechtsoort2', 1)->nullable();
                    $table->string('term', 1)->nullable();
                    $table->string('tonen', 1)->nullable();
                    $table->string('transit', 1)->nullable();
                    $table->string('val', 3)->nullable();
                    $table->string('verdicht', 1)->nullable();
                    $table->integer('versl')->nullable();
                    $table->integer('versl2')->nullable();
                    $table->boolean('vjp')->nullable();
                    $table->integer('xbrl')->nullable();
                    $table->string('zksl', 20)->nullable();
                });
            }
        }

        if (Schema::hasTable(ImuisDataTableEnum::GRB->value)) {
            Schema::table(ImuisDataTableEnum::GRB->value, function (Blueprint $table) {
                $table->index(['connect_id', 'hash'], 'idx_grb_hash');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ImuisDataTableEnum::GRB->value);
        Schema::dropIfExists('staging_'.ImuisDataTableEnum::GRB->value);
    }
};
