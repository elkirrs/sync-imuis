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
        $tables = [ImuisDataTableEnum::LAND->value, 'staging_'.ImuisDataTableEnum::LAND->value];
        foreach ($tables as $tableName) {

            if (! Schema::hasTable($tableName)) {
                Schema::create($tableName, function (Blueprint $table) {
                    $table->bigInteger('id')->autoIncrement();
                    $table->integer('connect_id');
                    $table->string('hash');

                    $table->integer('bankcdlen')->nullable();
                    $table->boolean('blok')->nullable();
                    $table->boolean('blokprofiel')->nullable();
                    $table->integer('btwgeenexcldienst')->nullable();
                    $table->integer('btwgeenexcllever')->nullable();
                    $table->integer('btwgeenincldienst')->nullable();
                    $table->integer('btwgeenincllever')->nullable();
                    $table->integer('btwhoogexcldienst')->nullable();
                    $table->integer('btwhoogexcllever')->nullable();
                    $table->integer('btwhoogincldienst')->nullable();
                    $table->integer('btwhoogincllever')->nullable();
                    $table->integer('btwlaagexcldienst')->nullable();
                    $table->integer('btwlaagexcllever')->nullable();
                    $table->integer('btwlaagincldienst')->nullable();
                    $table->integer('btwlaagincllever')->nullable();
                    $table->string('btwlandcd', 3)->nullable();
                    $table->string('btwpl', 1)->nullable();
                    $table->string('cbs', 3)->nullable();
                    $table->string('hrow')->nullable();
                    $table->integer('ibanlengte')->nullable();
                    $table->string('ibanstruct', 40)->nullable();
                    $table->string('internationaal', 40)->nullable();
                    $table->string('iso', 3)->nullable();
                    $table->string('omschr', 40)->nullable();
                    $table->string('sepa', 1)->nullable();
                    $table->string('taal', 3)->nullable();
                    $table->string('tel', 15)->nullable();
                    $table->string('valuta', 3)->nullable();
                    $table->string('zksl', 3)->nullable(); // primary key
                });
            }
        }

        if (Schema::hasTable(ImuisDataTableEnum::LAND->value)) {
            Schema::table(ImuisDataTableEnum::LAND->value, function (Blueprint $table) {
                $table->index(['connect_id', 'hash'], 'idx_land_hash');
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ImuisDataTableEnum::LAND->value);
        Schema::dropIfExists('staging_'.ImuisDataTableEnum::LAND->value);
    }
};
