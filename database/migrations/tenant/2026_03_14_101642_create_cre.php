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
        $tables = [ImuisDataTableEnum::CRE->value, 'staging_'.ImuisDataTableEnum::CRE->value];
        foreach ($tables as $tableName) {

            if (! Schema::hasTable($tableName)) {
                Schema::create($tableName, function (Blueprint $table) {
                    $table->bigInteger('id')->autoIncrement();
                    $table->integer('connect_id');
                    $table->string('hash');

                    $table->string('aanhef', 20)->nullable();
                    $table->string('adres', 50)->nullable();
                    $table->text('adressering')->nullable();
                    $table->integer('betcond')->nullable(); // verplicht
                    $table->string('betkenmverpl', 1)->nullable();
                    $table->string('betselafdruk', 1)->nullable();
                    $table->boolean('blok')->default(false);
                    $table->date('blokinkva')->nullable();
                    $table->string('bnkbnkrek', 11)->nullable();
                    $table->string('bnkgrek', 11)->nullable();
                    $table->string('bnkgiro', 11)->nullable();
                    $table->string('bnkiban', 34)->nullable();
                    $table->string('bnkrek', 15)->nullable();
                    $table->bigInteger('bnkreknum')->nullable(); // niet toegankelijk
                    $table->string('bnksrtbet', 1)->nullable();
                    $table->string('btwnr', 14)->nullable();
                    $table->string('btwpl', 1)->nullable(); // verplicht
                    $table->string('btwstatnaam', 100)->nullable();
                    $table->string('certsleutel', 20)->nullable();
                    $table->integer('dagbink')->nullable();
                    $table->date('dataangem')->nullable();
                    $table->date('datbtwnr')->nullable();
                    $table->date('datkrlimtm')->nullable();
                    $table->date('datkrlimvan')->nullable();
                    $table->date('datkvkuittr')->nullable();
                    $table->date('datlstbet')->nullable(); // niet toegankelijk
                    $table->date('datlstfact')->nullable(); // niet toegankelijk
                    $table->integer('deb')->nullable();
                    $table->string('econnectid', 50)->nullable();
                    $table->string('email', 64)->nullable();
                    $table->string('emailmailingjn', 1)->nullable();
                    $table->string('fax', 15)->nullable();
                    $table->decimal('franco', 15, 2)->nullable();
                    $table->string('giro', 15)->nullable();
                    $table->string('giroiban', 34)->nullable();
                    $table->string('gironaam', 50)->nullable();
                    $table->bigInteger('gironum')->nullable(); // niet toegankelijk
                    $table->string('gpscoordb', 20)->nullable();
                    $table->string('gpscoordl', 20)->nullable();
                    $table->string('grek', 15)->nullable();
                    $table->string('grekiban', 34)->nullable();
                    $table->string('greknaam', 50)->nullable();
                    $table->boolean('heeftsaldo')->nullable(); // niet toegankelijk
                    $table->integer('hnr')->nullable();
                    $table->string('hnrtv', 6)->nullable();
                    $table->string('homepage', 64)->nullable();
                    $table->string('inkoper', 20)->nullable();
                    $table->integer('kdr')->nullable();
                    $table->integer('kpl')->nullable();
                    $table->decimal('krlim', 15, 2)->nullable();
                    $table->string('kvknr', 15)->nullable();
                    $table->string('kvkplaats', 24)->nullable();
                    $table->string('kvkstatnaam', 100)->nullable();
                    $table->string('land', 3)->nullable();
                    $table->string('levcond', 20)->nullable();
                    $table->string('levsrt', 1)->nullable();
                    $table->integer('levtijd')->nullable();
                    $table->string('medew', 20)->nullable();
                    $table->string('medewfiatbet', 20)->nullable();
                    $table->string('medewfiatinkoop', 20)->nullable();
                    $table->string('mobiel', 15)->nullable();
                    $table->string('naam', 50)->nullable();
                    $table->string('naam2', 50)->nullable();
                    $table->string('naamubl', 100)->nullable();
                    $table->integer('nr')->nullable();
                    $table->string('nrbijcre', 20)->nullable();
                    $table->string('oin', 20)->nullable();
                    $table->string('opdrwz', 20)->nullable();
                    $table->text('opm')->nullable();
                    $table->text('opmint')->nullable();
                    $table->string('ordbevafdruk', 1)->nullable();
                    $table->string('plaats', 24)->nullable();
                    $table->string('postcd', 8)->nullable();
                    $table->string('prslst', 20)->nullable();
                    $table->string('rvorm', 3)->nullable();
                    $table->decimal('saldo', 15, 2)->nullable(); // niet toegankelijk
                    $table->string('sjabloon', 1)->nullable();
                    $table->integer('sluitrek')->nullable();
                    $table->string('straat', 37)->nullable();
                    $table->string('taal', 3)->nullable();
                    $table->decimal('tebetalen', 15, 2)->nullable(); // niet toegankelijk
                    $table->integer('tegrek')->nullable();
                    $table->string('tel', 15)->nullable();
                    $table->string('telprive', 15)->nullable();
                    $table->string('ubldoorboeken', 1)->nullable();
                    $table->string('val', 3)->nullable();
                    $table->string('verzwz', 20)->nullable();
                    $table->string('vrijveld1', 40)->nullable();
                    $table->string('vrijveld2', 40)->nullable();
                    $table->string('zksl', 20)->nullable();
                    $table->string('zkslext', 20)->nullable();
                });
            }
        }

        if (Schema::hasTable(ImuisDataTableEnum::CRE->value)) {
            Schema::table(ImuisDataTableEnum::CRE->value, function (Blueprint $table) {
                $table->index(['connect_id', 'hash'], 'idx_cre_hash');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ImuisDataTableEnum::CRE->value);
        Schema::dropIfExists('staging_'.ImuisDataTableEnum::CRE->value);
    }
};
