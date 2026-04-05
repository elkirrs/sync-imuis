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
            ImuisDataTableEnum::DEB->value,
            'staging_'.ImuisDataTableEnum::DEB->value,
        ];

        foreach ($tables as $tableName) {

            if (! Schema::hasTable($tableName)) {
                Schema::create($tableName, function (Blueprint $table) {
                    $table->bigInteger('id')->autoIncrement();
                    $table->integer('connect_id');
                    $table->string('hash');

                    $table->string('aanhef', 20)->nullable();
                    $table->boolean('aanm')->nullable();
                    $table->string('aanmafdruk', 1)->nullable();
                    $table->string('aanmvast', 20)->nullable();
                    $table->string('adres', 50)->nullable();
                    $table->text('adressering')->nullable();
                    $table->integer('betaler')->nullable();
                    $table->integer('betcond')->nullable();
                    $table->boolean('blok')->nullable();
                    $table->date('blokdeclva')->nullable();
                    $table->date('blokvrkva')->nullable();
                    $table->string('bnkbnkrek', 11)->nullable();
                    $table->string('bnkbnkrek2', 11)->nullable();
                    $table->string('bnkgiro', 11)->nullable();
                    $table->string('bnkgrek', 11)->nullable();
                    $table->string('bnkiban', 34)->nullable();
                    $table->string('bnkiban2', 34)->nullable();
                    $table->string('bnkrek', 15)->nullable();
                    $table->string('bnkrek2', 15)->nullable();
                    $table->bigInteger('bnkreknum')->nullable();  // Bankrekening numeriek
                    $table->bigInteger('bnkreknum2')->nullable(); // 3e Bankrekening numeriek
                    $table->string('bnksrtinc', 1)->nullable();     // Banksoort incasso
                    $table->string('btwnr', 14)->nullable();      // BTW-nummer
                    $table->string('btwpl', 1)->nullable();                     // BTW-plichtig, verplicht
                    $table->date('datbtwnr')->nullable();         // BTW verificatiedatum
                    $table->date('datklantaf')->nullable();       // Klant af
                    $table->date('datklantsinds')->nullable();    // Klant sinds
                    $table->date('datkrlimtm')->nullable();       // Einddatum kredietlimiet
                    $table->date('datkrlimvan')->nullable();      // Begindatum kredietlimiet
                    $table->date('datkvkuittr')->nullable();      // Kvk datum uittreksel
                    $table->date('datlstaanm')->nullable();       // Laatste aanmaning (niet toegankelijk)
                    $table->date('datlstbet')->nullable();        // Laatste betaling (niet toegankelijk)
                    $table->date('datlstfact')->nullable();       // Laatste factuur (niet toegankelijk)
                    $table->date('datoprichting')->nullable();    // Oprichtingsdatum/geboortedatum
                    $table->string('decbudverpl', 1)->nullable();  // Gebruik declaratiebudget verplicht
                    $table->string('decltoel', 1)->nullable();     // Afdrukken toelichting bij declaratie
                    $table->bigInteger('eannr')->nullable();      // EAN nummer
                    $table->string('email', 64)->nullable();      // E-mail
                    $table->string('emailmailingjn', 1)->nullable(); // Nieuwsbrief e-mailen
                    $table->integer('extaanbrengrel')->nullable(); // Aanbrenger extern (contactpersoon)relatie
                    $table->string('extaanbrengzksl', 20)->nullable();
                    $table->string('factafdruk', 1)->nullable();        // Facturen afdrukken of e-mailen
                    $table->boolean('factoring')->nullable();         // Factoring
                    $table->string('facvrknaardeb', 1)->nullable();     // Artikel/debiteur voorkeursafspraken overnemen
                    $table->string('fax', 15)->nullable();            // Fax
                    $table->string('gebrstaffel', 1)->nullable();       // Staffel gebruiken
                    $table->string('gebrverkkostpr', 1)->nullable();    // Kostprijs gebruiken als verkoopprijs
                    $table->string('giro', 15)->nullable();           // 2e Bankrekening
                    $table->string('giroiban', 34)->nullable();       // 2e Bankrekening IBAN
                    $table->string('gironaam', 40)->nullable();       // Tenaamstelling 2e bankrekening
                    $table->bigInteger('gironum')->nullable();        // 2e Bankrekening numeriek
                    $table->string('grek', 15)->nullable();           // G-rekening
                    $table->string('grekiban', 34)->nullable();       // G-rekening IBAN
                    $table->bigInteger('greknum')->nullable();        // G-rekening numeriek
                    $table->integer('grpdeb')->nullable();            // Groepsdebiteur
                    $table->boolean('heeftsaldo')->nullable();        // Heeft saldo
                    $table->integer('hnr')->nullable();               // Huisnummer
                    $table->string('hnrtv', 6)->nullable();           // Huisnummertoevoeging
                    $table->string('homepage', 64)->nullable();       // Homepage
                    $table->string('incselafdruk', 1)->nullable();      // Specificatie incasso's afdrukken of e-mailen
                    $table->bigInteger('inkcomb')->nullable();        // Inkoopcombinatie
                    $table->integer('jrdecltm')->nullable();          // Declaratie t/m jaar (niet toegankelijk)
                    $table->integer('jrdeclvan')->nullable();         // Declaratie vanaf jaar (niet toegankelijk)
                    $table->bigInteger('kdr')->nullable();            // KOSTENDRAGER
                    $table->string('kenmopp', 25)->nullable();        // Kenmerk voor openstaande posten
                    $table->string('kixcd', 20)->nullable();           // Kixcode (niet toegankelijk)
                    $table->string('klantaftekst', 20)->nullable();    // Klant af tekst
                    $table->string('klantsindstekst', 20)->nullable(); // Klant sinds tekst
                    $table->bigInteger('kpl')->nullable();             // KOSTENPLAATS
                    $table->decimal('krlim', 18, 2)->nullable();       // Kredietlimiet
                    $table->string('kvknr', 15)->nullable();           // Kvk-nummer
                    $table->string('kvkplaats', 24)->nullable();       // Kvk-plaats
                    $table->boolean('laagstebedr')->nullable();        // Laagste bedrag
                    $table->string('land', 3)->nullable();             // Land
                    $table->string('levcond', 20)->nullable();         // Voorkeursleveringsconditie
                    $table->string('medew', 20)->nullable();           // Verantwoordelijk medewerker
                    $table->string('medewaanbreng', 20)->nullable();   // Aanbrenger intern (medewerker)
                    $table->string('medewdec', 20)->nullable();        // Verantwoordelijk medewerker declaraties/urenverantwoording
                    $table->string('medewfiscaal', 20)->nullable();    // Fiscale medewerker
                    $table->string('medewloon', 20)->nullable();       // Loon medewerker
                    $table->string('medewvennoot', 20)->nullable();    // Verantwoordelijke vennoot
                    $table->string('mobiel', 15)->nullable();          // Telefoon mobiel
                    $table->string('naam', 50)->nullable();            // Naam
                    $table->string('naam2', 50)->nullable();           // Ter attentie van
                    $table->bigInteger('nr')->nullable();              // Nummer (verplicht)
                    $table->string('nrbijdeb', 20)->nullable();        // Ons crediteurnummer bij debiteur
                    $table->bigInteger('nrrit')->nullable();           // Nummer in de rit
                    $table->string('offafdruk', 1)->nullable();          // Offerte afdrukken of e-mailen
                    $table->string('opdrwz', 20)->nullable();          // Voorkeursopdrachtwijze
                    $table->text('opm')->nullable();                   // Opmerking
                    $table->string('ordbevafdruk', 1)->nullable();       // Orderbevestigingen afdrukken of e-mailen
                    $table->string('ordercompleet', 1)->nullable();      // Order compleet leveren
                    $table->string('ordsrt', 20)->nullable();          // Voorkeursordersoort
                    $table->string('pakbemail', 1)->nullable();         // Verzendbon ook e-mailen
                    $table->decimal('percgrek', 8, 2)->nullable();     // Perc. uit loonbestanddeel voor G-rekening
                    $table->string('plaats', 24)->nullable();          // Woonplaats
                    $table->decimal('plm', 18, 2)->nullable();         // Bedrag plus/min (niet toegankelijk)
                    $table->integer('pndecltm')->nullable();           // Declaratie t/m periode (niet toegankelijk)
                    $table->integer('pndeclvan')->nullable();          // Declaratie vanaf periode (niet toegankelijk)
                    $table->string('postcd', 8)->nullable();           // Postcode
                    $table->string('prg', 12)->nullable();             // Gegenereerd door (niet toegankelijk)
                    $table->bigInteger('prosp')->nullable();           // Was prospectnummer
                    $table->string('prslst', 20)->nullable();          // Artikelprijslijst
                    $table->bigInteger('rayon')->nullable();           // Rayon
                    $table->bigInteger('rit')->nullable();             // Rit
                    $table->string('rvorm', 3)->nullable();            // Rechtsvorm
                    $table->decimal('saldo', 18, 2)->nullable();       // Saldo (niet toegankelijk)
                    $table->bigInteger('sluitrek')->nullable();        // Sluitrekening (verplicht)
                    $table->string('statnaam', 40)->nullable();        // Statutaire naam
                    $table->string('statplaats', 24)->nullable();      // Statutaire plaats
                    $table->string('straat', 37)->nullable();          // Straat
                    $table->string('taal', 3)->nullable();            // Taal
                    $table->bigInteger('tegrek')->nullable();          // Voorkeurstegenrekening
                    $table->string('tel', 15)->nullable();             // Telefoon
                    $table->string('telprive', 15)->nullable();        // Telefoon privé
                    $table->decimal('teontvinc', 18, 2)->nullable();   // Te ontvangen Incasso (niet toegankelijk)
                    $table->string('term', 1)->nullable();               // Termijn t.b.v. contracten
                    $table->string('termijnfact', 1)->nullable();        // Factuurtermijn
                    $table->string('val', 3)->nullable();              // Valuta
                    $table->string('vastectrdatum', 1)->nullable();      // Vaste datum t.b.v. contracten
                    $table->string('verkoper', 20)->nullable();    // Verkoper
                    $table->boolean('verr')->nullable();           // Verrekenbaar
                    $table->string('verzfact', 1)->nullable();      // Verzamelfactuur
                    $table->string('verzwz', 20)->nullable();      // Voorkeursverzendwijze
                    $table->string('voors', 1)->nullable();          // Voorschotten
                    $table->string('vrijveld1', 40)->nullable();   // DEBVRIJVELD1
                    $table->string('vrijveld2', 40)->nullable();   // DEBVRIJVELD2
                    $table->string('vrijveld3', 20)->nullable();   // DEBVRIJVELD3
                    $table->string('vrijveld4', 20)->nullable();   // DEBVRIJVELD4
                    $table->string('vrijveld5', 20)->nullable();   // DEBVRIJVELD5
                    $table->string('zksl', 20);                    // Zoeksleutel (primary key, verplicht)
                });
            }

        }

        if (Schema::hasTable(ImuisDataTableEnum::DEB->value)) {
            Schema::table(ImuisDataTableEnum::DEB->value, function (Blueprint $table) {
                $table->index(['connect_id', 'hash'], 'idx_dep_hash');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ImuisDataTableEnum::DEB->value);
        Schema::dropIfExists('staging_'.ImuisDataTableEnum::DEB->value);
    }
};
