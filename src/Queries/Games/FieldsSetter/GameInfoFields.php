<?php

namespace Hlis\SlotsMateModels\Queries\Games\FieldsSetter;

use Hlis\GlobalModels\Queries\Games\FieldsSetter\GameInfoFields as GlobalFields;
use Lucinda\Query\Clause\Fields;

class GameInfoFields extends GlobalFields
{
    public function appendFields(Fields $fields): void
    {
        $fields->add("t1.id");
        $fields->add("t1.name");
        $fields->add("t1.date_launched");
        $fields->add("t1.paylines");
        $fields->add("t1.reels");
        $fields->add("t1.min_cpl");
        $fields->add("t1.max_cpl");
        $fields->add("t1.min_cs");
        $fields->add("t1.max_cs");
        $fields->add("t1.rtp");
        $fields->add('t1.is_best');
        $fields->add('t1.is_hot');
        $fields->add('t1.is_open');
        $fields->add('t1.noindex');
        $fields->add("t1.game_volatility_id", "volatility_id");
        $fields->add("gm.name", "game_manufacturer_name");
        $fields->add("gm.id", "game_manufacturer_id");
        $fields->add("gv.name", "volatility_name");
        $fields->add("gt.id", "game_type_id");
        $fields->add("gt.name", "game_type_name");
        $fields->add('IF(gpp.id IS NOT NULL,1,0)', 'is_mobile');
        $fields->add('MAX(gp.value)', 'max_win_pl');
        $fields->add("IF(lgm.id IS NOT NULL,1,0) AS softwareLocaleSupported");
    }
}