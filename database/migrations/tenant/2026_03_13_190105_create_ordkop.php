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
            ImuisDataTableEnum::ORDKOP->value,
            'staging_'.ImuisDataTableEnum::ORDKOP->value,
        ];

        foreach ($tables as $tableName) {

            if (! Schema::hasTable($tableName)) {
                Schema::create($tableName, function (Blueprint $table) {
                    $table->bigInteger('id')->autoIncrement();
                    $table->integer('connect_id');
                    $table->string('hash');

                    $table->decimal('bedrbetkort', 18, 4)->nullable();
                    $table->decimal('bedrbetkortincl', 18, 4)->nullable();
                    $table->decimal('bedrbineu', 18, 4)->nullable();
                    $table->decimal('bedrbuieu', 18, 4)->nullable();
                    $table->decimal('bedrfact', 18, 4)->nullable();
                    $table->decimal('bedrgeen', 18, 4)->nullable();
                    $table->decimal('bedrgrek', 18, 4)->nullable();
                    $table->decimal('bedrhoog', 18, 4)->nullable();
                    $table->decimal('bedrinclbineu', 18, 4)->nullable();
                    $table->decimal('bedrinclbuieu', 18, 4)->nullable();
                    $table->decimal('bedrinclfact', 18, 4)->nullable();
                    $table->decimal('bedrinclgeen', 18, 4)->nullable();
                    $table->decimal('bedrinclhoog', 18, 4)->nullable();
                    $table->decimal('bedrincllaag', 18, 4)->nullable();
                    $table->decimal('bedrinclopen', 18, 4)->nullable();
                    $table->decimal('bedrincltot', 18, 4)->nullable();
                    $table->decimal('bedrinclverlegd', 18, 4)->nullable();
                    $table->decimal('bedrkb', 18, 4)->nullable();
                    $table->decimal('bedrkbincl', 18, 4)->nullable();
                    $table->decimal('bedrkostpr', 18, 4)->nullable();
                    $table->decimal('bedrlaag', 18, 4)->nullable();
                    $table->decimal('bedropen', 18, 4)->nullable();
                    $table->decimal('bedrordkst', 18, 4)->nullable();
                    $table->decimal('bedrordkstfactin', 18, 4)->nullable();
                    $table->decimal('bedrordkstgefact', 18, 4)->nullable();
                    $table->string('bedrordkstgewijz', 1)->nullable();
                    $table->decimal('bedrordkstincl', 18, 4)->nullable();
                    $table->decimal('bedrtot', 18, 4)->nullable();
                    $table->decimal('bedrverlegd', 18, 4)->nullable();
                    $table->decimal('bedrvrachtkst', 18, 4)->nullable();
                    $table->string('bedrvrachtkstwz', 1)->nullable();
                    $table->decimal('bedrvrkstfactinc', 18, 4)->nullable();
                    $table->decimal('bedrvrkstgefact', 18, 4)->nullable();
                    $table->decimal('bedrvrkstincl', 18, 4)->nullable();
                    $table->integer('betaler')->nullable();
                    $table->string('betcode', 1)->nullable();
                    $table->integer('betcond')->nullable();
                    $table->boolean('blok')->nullable();
                    $table->string('btwpl', 1)->nullable();
                    $table->date('dat')->nullable();
                    $table->date('datlev')->nullable();
                    $table->string('datlevgewijz', 1)->nullable();
                    $table->date('datlevuiterst')->nullable();
                    $table->date('datordbev')->nullable();
                    $table->date('datpick')->nullable();
                    $table->date('datvast')->nullable();
                    $table->dateTime('datvrwrk')->nullable();
                    $table->integer('deb')->nullable();
                    $table->integer('extordnr')->nullable();
                    $table->string('gebrordbev', 1)->nullable();
                    $table->string('gefact', 1)->nullable();
                    $table->string('incasso', 1)->nullable();
                    $table->string('isincl', 1)->nullable();
                    $table->integer('kdr')->nullable();
                    $table->string('kenm', 25)->nullable();
                    $table->integer('kpl')->nullable();
                    $table->string('levcond', 20);
                    $table->integer('mag')->nullable();
                    $table->string('mdt', 35)->nullable();
                    $table->string('medewvast', 20)->nullable();
                    $table->integer('nr')->nullable();
                    $table->integer('nrrit')->nullable();
                    $table->string('opdrwz', 20);
                    $table->string('opm', 250)->nullable();
                    $table->string('ordercompleet', 1)->nullable();
                    $table->string('ordsrt', 20)->nullable();
                    $table->decimal('percbetkort', 6, 3)->nullable();
                    $table->decimal('percgrek', 6, 3)->nullable();
                    $table->decimal('perckb', 6, 3)->nullable();
                    $table->decimal('percloon', 6, 3)->nullable();
                    $table->string('prslst', 20)->nullable();
                    $table->integer('rit')->nullable();
                    $table->string('selcd', 20)->nullable();
                    $table->string('taal', 3)->nullable();
                    $table->string('tefact', 1)->nullable();
                    $table->string('val', 3)->nullable();
                    $table->string('verkoper', 20)->nullable();
                    $table->integer('vervdgn')->nullable();
                    $table->string('verzadres', 50)->nullable();
                    $table->text('verzadressering')->nullable();
                    $table->integer('verzcntrel')->nullable();
                    $table->string('verzcntzksl', 20)->nullable();
                    $table->integer('verzdeb')->nullable();
                    $table->string('verzemail', 64)->nullable();
                    $table->integer('verzhnr')->nullable();
                    $table->string('verzhnrtv', 6)->nullable();
                    $table->string('verzland', 3)->nullable();
                    $table->string('verznaam', 50)->nullable();
                    $table->string('verznaam2', 50)->nullable();
                    $table->string('verzplaats', 24)->nullable();
                    $table->string('verzpostcd', 8)->nullable();
                    $table->string('verzstraat', 37)->nullable();
                    $table->string('verztel', 15)->nullable();
                    $table->string('verzwz', 20)->nullable();
                    $table->string('verzzksl', 20)->nullable();
                    $table->decimal('volume', 14, 4)->nullable();
                });
            }
        }

        if (Schema::hasTable(ImuisDataTableEnum::ORDKOP->value)) {
            Schema::table(ImuisDataTableEnum::ORDKOP->value, function (Blueprint $table) {
                $table->index(['connect_id', 'hash'], 'idx_ordkop_hash');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ImuisDataTableEnum::ORDKOP->value);
        Schema::dropIfExists('staging_'.ImuisDataTableEnum::ORDKOP->value);
    }
};
