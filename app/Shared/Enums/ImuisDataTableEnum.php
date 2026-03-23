<?php

declare(strict_types=1);

namespace App\Shared\Enums;

enum ImuisDataTableEnum: string
{
    case DEB = 'DEB';
    case DEBOPP = 'DEBOPP';
    case BETCOND = 'BETCOND';
    case BTW = 'BTW';
    case ART = 'ART';
    case ARTGRP = 'ARTGRP';
    case ORDKOP = 'ORDKOP';
    case ORDRG = 'ORDRG';
    case VAL = 'VAL';
    case GRB = 'GRB';
    case KPL = 'KPL';
    case KDR = 'KDR';
    case GRBMUT = 'GRBMUT';
    case CRE = 'CRE';
    case LAND = 'LAND';
    case KOERS = 'KOERS';
    case SELCODE = 'SELCODE';
    case TAAL = 'TAAL';
    case BEOORCODE = 'BEOORCODE';
    case DOSSIER = 'DOSSIER';
    case VERSL = 'VERSL';
    case DAGBOEK = 'DAGBOEK';

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
        ];
    }

    public static function ListNames(): array
    {
        return [
            self::DEB->name => 'Debiteur',
            self::DEBOPP->name => 'Debiteur openstaande posten/Facturen',
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
        ];
    }

    public static function toStringList(): string
    {
        $list = array_map(fn ($item) => $item->value, self::cases());

        return implode(',', $list);
    }
}
