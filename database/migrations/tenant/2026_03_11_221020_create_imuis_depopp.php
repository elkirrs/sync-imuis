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
        $tables = [ImuisDataTableEnum::DEBOPP->value, 'staging_'.ImuisDataTableEnum::DEBOPP->value];

        foreach ($tables as $tableName) {

            if (! Schema::hasTable($tableName)) {
                Schema::create($tableName, function (Blueprint $table) {

                    $table->bigInteger('id')->autoIncrement();
                    $table->integer('connect_id');
                    $table->string('hash');

                    $table->integer('aanm')->nullable();                   // Aantal aanmaningen
                    $table->integer('aantinc')->nullable();               // Aantal incasso's geweigerd
                    $table->decimal('bedr', 14, 2)->nullable();           // Bedrag (niet toegankelijk)
                    $table->decimal('bedrbetkort', 14, 2)->nullable();    // Betalingskorting (niet toegankelijk)
                    $table->decimal('bedrbetkortval', 14, 2)->nullable(); // Valuta betalingskorting (niet toegankelijk)
                    $table->decimal('bedrbetkrtteinc', 14, 2)->nullable(); // Te verrekenen betalingskorting
                    $table->decimal('bedrbkrtteincval', 14, 2)->nullable(); // Valuta te verrekenen betalingskorting
                    $table->decimal('bedrbtw', 14, 2)->nullable();       // BTW bedrag
                    $table->decimal('bedrbtwval', 14, 2)->nullable();    // Valuta BTW-bedrag
                    $table->decimal('bedrkb', 14, 2)->nullable();        // Kredietbeperking
                    $table->decimal('bedrkbval', 14, 2)->nullable();     // Valuta kredietbeperking
                    $table->decimal('bedroorsprval', 14, 2)->nullable(); // Bedrag oorspronkelijke valuta
                    $table->decimal('bedrval', 14, 2)->nullable();       // Valuta bedrag
                    $table->decimal('bet', 14, 2)->nullable();           // Betaald
                    $table->integer('betaler')->nullable();              // Betalingsplichtige (niet toegankelijk, verplicht)
                    $table->integer('betcond')->nullable();              // Betalingsconditie
                    $table->integer('betregdeb')->nullable();            // Betalingsregeling bij factuur:debiteur
                    $table->string('betregfact', 20)->nullable();        // Betalingsregeling bij factuur:factuur
                    $table->decimal('betval', 14, 2)->nullable();        // Valuta betaald
                    $table->boolean('betwist')->nullable();              // Betwiste factuur
                    $table->string('bnkrek', 38)->nullable();           // Bankrekening
                    $table->integer('creditnotadeb')->nullable();        // Hoort bij factuur:debiteur
                    $table->string('creditnotafact', 20)->nullable();    // Hoort bij factuur:factuur
                    $table->date('dat')->nullable();                     // Datum (niet toegankelijk)
                    $table->date('datlstaanm')->nullable();               // Datum laatste aanmaning
                    $table->date('datlstbet')->nullable();              // Datum laatste betaling (niet toegankelijk)
                    $table->date('datuitv')->nullable();                 // Gewenste verwerkingsdatum incasso
                    $table->date('datverv')->nullable();                // Vervaldatum
                    $table->integer('deb');                              // Debiteur (primary key, niet toegankelijk, verplicht)
                    $table->integer('deborder')->nullable();            // Orderdebiteur
                    $table->string('fact', 20);                          // Factuur (primary key, niet toegankelijk, verplicht)
                    $table->integer('kdr')->nullable();                 // Kostendrager
                    $table->string('kenm', 25)->nullable();             // Kenmerk
                    $table->integer('kpl')->nullable();                 // Kostenplaats
                    $table->string('mdt', 35)->nullable();              // Incassomachtiging
                    $table->string('omschr', 40)->nullable();           // Omschrijving
                    $table->text('opm')->nullable();                    // Opmerking (MEMO)
                    $table->decimal('saldo', 14, 2)->nullable();        // Saldo (niet toegankelijk)
                    $table->decimal('saldooorsprval', 14, 2)->nullable(); // SaldoOorsprVal
                    $table->decimal('saldoval', 14, 2)->nullable();     // Valuta saldo
                    $table->string('uithanden', 1)->nullable();           // Uit handen gegeven
                    $table->string('val', 3)->nullable();                 // Valuta (niet toegankelijk)
                    $table->boolean('voldaan')->nullable();            // Voldaan (niet toegankelijk)
                });
            }
        }

        if (Schema::hasTable(ImuisDataTableEnum::DEBOPP->value)) {
            Schema::table(ImuisDataTableEnum::DEBOPP->value, function (Blueprint $table) {
                $table->index(['connect_id', 'fact'], 'idx_debopp_hash');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ImuisDataTableEnum::DEBOPP->value);
        Schema::dropIfExists('staging_'.ImuisDataTableEnum::DEBOPP->value);
    }
};
