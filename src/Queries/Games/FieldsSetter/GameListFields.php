<?php

namespace Hlis\SlotsMateModels\Queries\Games\FieldsSetter;

use Hlis\GlobalModels\Queries\Games\FieldsSetter\GameListFields as GameListFieldsGlobal;
use Hlis\SlotsMateModels\Enums\GameSortCriteria;
use Lucinda\Query\Clause\Fields;

class GameListFields extends GameListFieldsGlobal
{
    public function appendFields(Fields $fields): void
    {
//        parent::appendFields($fields);
        $fields->add("DISTINCT t1.id");
        $fields->add("t1.name");
        $fields->add("t1.date_launched");
        $fields->add("gm.id", "game_manufacturer_id");
        $fields->add("gm.name", "game_manufacturer_name");
        $fields->add('t1.rtp');
        $fields->add('t1.is_best');
        $fields->add('t1.is_hot');
        $fields->add('t1.is_mobile');
        $fields->add('(gp_m.id IS NOT NULL) AS has_demo');
        $fields->add("IF(lgm.id IS NOT NULL,1,0) AS softwareLocaleSupported");
        if($this->filter->getSort() == GameSortCriteria::BEST || $this->filter->getSort() == GameSortCriteria::MOST_PLAYED) {
            $fields->add('gv.score');
        }
    }
}