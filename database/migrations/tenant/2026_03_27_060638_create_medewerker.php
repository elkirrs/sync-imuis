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
            ImuisDataTableEnum::MEDEWERKER->value,
            'staging_'.ImuisDataTableEnum::MEDEWERKER->value,
        ];

        foreach ($tables as $tableName) {

            if (! Schema::hasTable($tableName)) {
                Schema::create($tableName, function (Blueprint $table) {
                    $table->bigInteger('id')->autoIncrement();
                    $table->integer('connect_id');
                    $table->string('hash');

                    $table->string('aanhef')->nullable();
                    $table->string('achternm')->nullable();
                    $table->string('afd')->nullable();
                    $table->boolean('blok')->nullable();
                    $table->string('burgst')->nullable();
                    $table->integer('cre')->nullable();
                    $table->string('datafwtm')->nullable();
                    $table->string('datafwvan')->nullable();
                    $table->string('dateindcontr')->nullable();
                    $table->string('datgeb')->nullable();
                    $table->string('datindienst')->nullable();
                    $table->string('datuitdienst')->nullable();
                    $table->string('email')->nullable();
                    $table->string('geslacht')->nullable();
                    $table->boolean('isbudh')->nullable();
                    $table->boolean('isdirecteur')->nullable();
                    $table->string('iseindcontr')->nullable();
                    $table->boolean('isext')->nullable();
                    $table->boolean('isinkoper')->nullable();
                    $table->string('isvennoot')->nullable();
                    $table->boolean('isverkoper')->nullable();
                    $table->integer('kdr')->nullable();
                    $table->integer('kpl')->nullable();
                    $table->integer('mag')->nullable();
                    $table->string('medfn')->nullable();
                    $table->string('meisjesnm')->nullable();
                    $table->string('mobiel')->nullable();
                    $table->text('opm')->nullable();
                    $table->string('ordsrt')->nullable();
                    $table->string('persnr')->nullable();
                    $table->string('roepnm')->nullable();
                    $table->string('tel')->nullable();
                    $table->string('telprive')->nullable();
                    $table->string('titel')->nullable();
                    $table->string('titelachter')->nullable();
                    $table->string('tsnvgsl')->nullable();
                    $table->string('voorltrs')->nullable();
                    $table->string('zksl')->nullable();
                });
            }
        }

        if (Schema::hasTable(ImuisDataTableEnum::MEDEWERKER->value)) {
            Schema::table(ImuisDataTableEnum::MEDEWERKER->value, function (Blueprint $table) {
                $table->index(['connect_id', 'hash'], 'idx_medewerker_hash');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ImuisDataTableEnum::MEDEWERKER->value);
        Schema::dropIfExists('staging_'.ImuisDataTableEnum::MEDEWERKER->value);
    }
};
