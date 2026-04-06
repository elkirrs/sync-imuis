<?php

declare(strict_types=1);

namespace App\Shared\Enums;

enum ImuisDataTableEnum: string
{
    case DEB = 'DEBXU';
    case DEBOPP = 'DEBOPPXU';
    case BETCOND = 'BETCDXU';
    case BTW = 'BTWXU';
    case ART = 'ARTXU';
    case ARTGRP = 'ARTGRPXU';
    case ORDKOP = 'ORDKOPXU';
    case ORDRG = 'ORDRGXU';
    case VAL = 'VALXU';
    case GRB = 'GRBXU';
    case KPL = 'KPLXU';
    case KDR = 'KDRXU';
    case GRBMUT = 'GRBMUTXU';
    case CRE = 'CREXU';
    case LAND = 'LANDXU';
    case KOERS = 'KOERSXU';
    case SELCODE = 'SELCDXU';
    case TAAL = 'TAALXU';
    case BEOORCODE = 'BEOORXU';
    case DOSSIER = 'DOSSXU';
    case VERSL = 'VERSLXU';
    case DAGBOEK = 'DAGBXU';
    case PERIODESALDI = 'PERIODESALDI';
    case BOE = 'BOE';
    case MEDEWERKER = 'MEDEWERKER';
    case CREOPP = 'CREOPP';

    public static function List(): array
    {
        return [
            self::DEB->name => self::DEB->name,
            self::DEBOPP->name => self::DEBOPP->name,
            self::BETCOND->name => self::BETCOND->name,
            self::BTW->name => self::BTW->name,
            self::ART->name => self::ART->name,
            self::ARTGRP->name => self::ARTGRP->name,
            self::ORDKOP->name => self::ORDKOP->name,
            self::ORDRG->name => self::ORDRG->name,
            self::VAL->name => self::VAL->name,
            self::GRB->name => self::GRB->name,
            self::KPL->name => self::KPL->name,
            self::KDR->name => self::KDR->name,
            self::GRBMUT->name => self::GRBMUT->name,
            self::CRE->name => self::CRE->name,
            self::LAND->name => self::LAND->name,
            self::KOERS->name => self::KOERS->name,
            self::SELCODE->name => self::SELCODE->name,
            self::TAAL->name => self::TAAL->name,
            self::BEOORCODE->name => self::BEOORCODE->name,
            self::DOSSIER->name => self::DOSSIER->name,
            self::VERSL->name => self::VERSL->name,
            self::DAGBOEK->name => self::DAGBOEK->name,
            self::BOE->name => self::BOE->name,
            self::MEDEWERKER->name => self::MEDEWERKER->name,
            self::CREOPP->name => self::CREOPP->name,
            //            self::PERIODESALDI->name => self::PERIODESALDI->name,
        ];
    }

    public static function ListNames(): array
    {
        return [
            self::DEB->name => 'Debiteur',
            self::DEBOPP->name => 'Debiteur openstaande posten',
            self::BETCOND->name => 'Betalingsconditie',
            self::BTW->name => 'BTW code',
            self::ART->name => 'Artikelen',
            self::ARTGRP->name => 'Artikelgroepen',
            self::ORDKOP->name => 'Verkooporderkoppen',
            self::ORDRG->name => 'Verkooporderregels',
            self::VAL->name => 'Valuta',
            self::GRB->name => 'Grootboekrekeningen',
            self::KPL->name => 'Kostenplaatsen',
            self::KDR->name => 'Kostendrager',
            self::GRBMUT->name => 'Grootboekmutaties',
            self::CRE->name => 'Crediteur',
            self::LAND->name => 'Landen',
            self::KOERS->name => 'Valutakoersen',
            self::SELCODE->name => 'Selectiecodes',
            self::TAAL->name => 'Talen',
            self::BEOORCODE->name => 'Beoordelingscode',
            self::DOSSIER->name => 'Dossier / WKR codes',
            self::VERSL->name => 'Verslaglegging',
            self::DAGBOEK->name => 'Dagboeken',
            self::BOE->name => 'Boekingen',
            self::MEDEWERKER->name => 'Medewerkers',
            self::CREOPP->name => 'Crediteur openstaande posten',
            //            self::PERIODESALDI->name => 'Periodesaldi',
        ];
    }

    public static function toStringList(): string
    {
        $list = array_map(fn ($item) => $item->name, self::cases());

        return implode(',', $list);
    }

    public static function fromName(string $name): ?self
    {
        return array_find(self::cases(), fn ($case) => $case->name === $name);

    }
}
