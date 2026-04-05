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
            ImuisDataTableEnum::CREOPP->value,
            'staging_'.ImuisDataTableEnum::CREOPP->value,
        ];

        foreach ($tables as $tableName) {

            if (! Schema::hasTable($tableName)) {
                Schema::create($tableName, function (Blueprint $table) {
                    $table->bigInteger('id')->autoIncrement();
                    $table->integer('connect_id');
                    $table->string('hash');

                    $table->string('aflgebr')->nullable();
                    $table->decimal('bedr', 15, 2)->nullable();
                    $table->decimal('bedrbkrttebetval', 15, 2)->nullable();
                    $table->decimal('bedrbtw', 15, 2)->nullable();
                    $table->decimal('bedrbtwval', 15, 2)->nullable();
                    $table->decimal('bedrgrek', 15, 2)->nullable();
                    $table->decimal('bedrkb', 15, 2)->nullable();
                    $table->decimal('bedrkbval', 15, 2)->nullable();
                    $table->decimal('bedroorsprval', 15, 2)->nullable();
                    $table->decimal('bedrtebet', 15, 2)->nullable();
                    $table->decimal('bedrval', 15, 2)->nullable();
                    $table->decimal('bet', 15, 2)->nullable();
                    $table->decimal('betgrek', 15, 2)->nullable();
                    $table->decimal('betval', 15, 2)->nullable();
                    $table->boolean('betwist')->nullable();
                    $table->unsignedBigInteger('cre');
                    $table->unsignedBigInteger('creditnotacre')->nullable();
                    $table->string('creditnotafact')->nullable();
                    $table->date('dat')->nullable();
                    $table->date('datlstbet')->nullable();
                    $table->date('datverv')->nullable();
                    $table->string('fact');
                    $table->boolean('fiat')->nullable();
                    $table->string('fiatinkoop')->nullable();
                    $table->boolean('incasso')->nullable();
                    $table->unsignedBigInteger('kdr')->nullable();
                    $table->string('kenm')->nullable();
                    $table->string('kenmbatch')->nullable();
                    $table->unsignedBigInteger('kpl')->nullable();
                    $table->string('omschr')->nullable();
                    $table->text('opm')->nullable();
                    $table->decimal('saldo', 15, 2)->nullable();
                    $table->decimal('saldogrek', 15, 2)->nullable();
                    $table->decimal('saldooorsprval', 15, 2)->nullable();
                    $table->decimal('saldoval', 15, 2)->nullable();
                    $table->boolean('voldaan')->nullable();
                });
            }
        }

        if (Schema::hasTable(ImuisDataTableEnum::CREOPP->value)) {
            Schema::table(ImuisDataTableEnum::CREOPP->value, function (Blueprint $table) {
                $table->index(['connect_id', 'hash'], 'idx_creopp_hash');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ImuisDataTableEnum::CREOPP->value);
        Schema::dropIfExists('staging_'.ImuisDataTableEnum::CREOPP->value);
    }
};
