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
        $tables = ['versl', 'staging_versl'];
        foreach ($tables as $tableName) {

            if (! Schema::hasTable($tableName)) {
                Schema::create($tableName, function (Blueprint $table) {
                    $table->bigInteger('id')->autoIncrement();
                    $table->integer('connect_id');
                    $table->string('hash');

                    $table->boolean('aanhef')->nullable();
                    $table->string('apbl', 1)->nullable();
                    $table->boolean('blok')->nullable();
                    $table->boolean('blokprofiel')->nullable();
                    $table->string('finposcd', 1)->nullable();
                    $table->integer('finposnr')->nullable();
                    $table->string('hrow')->nullable();
                    $table->string('kasstrcd', 1)->nullable();
                    $table->integer('kasstrnr')->nullable();
                    $table->string('nieuwepaggrond', 1)->nullable();
                    $table->string('nieuwepagina', 1)->nullable();
                    $table->string('nieuwpagapbl', 1)->nullable();
                    $table->string('nieuwpagresult', 1)->nullable();
                    $table->integer('nivo')->nullable();
                    $table->integer('nr')->nullable(); // primary key
                    $table->string('omschr', 40)->nullable();
                    $table->string('onverdichtpubl', 1)->nullable();
                    $table->string('opapbl', 1)->nullable();
                    $table->string('opresultaat', 1)->nullable();
                    $table->string('optoelichting', 1)->nullable();
                    $table->string('optoelpublicatie', 1)->nullable();
                    $table->string('selcd', 20)->nullable();
                    $table->string('toelverdicht', 1)->nullable();
                    $table->bigInteger('volgnr')->nullable();
                    $table->string('zksl', 20)->nullable();
                });
            }
        }

        if (Schema::hasTable('versl')) {
            Schema::table('versl', function (Blueprint $table) {
                $table->index(['connect_id', 'hash'], 'idx_versl_hash');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('versl');
        Schema::dropIfExists('staging_versl');
    }
};
