<?php

namespace Hlis\SlotsMateModels\Queries\Games\FieldsSetter;

use Hlis\GlobalModels\Queries\Games\FieldsSetter\GameListFields as GameListFieldsGlobal;
use Hlis\SlotsMateModels\Enums\GameSortCriteria;
use Lucinda\Query\Clause\Fields;

class GameListFields extends GameListFieldsGlobal
{
    public function appendFields(Fields $fields): void
    {
        parent::appendFields($fields);
        $fields->add('t1.rtp');
        $fields->add('t1.is_best');
        $fields->add('t1.is_hot');
        $fields->add('t1.is_mobile');
        $fields->add('COALESCE(t1.is_mobile OR t1.is_desktop) AS has_demo');
        if($this->filter->getSort() == GameSortCriteria::BEST || $this->filter->getSort() == GameSortCriteria::MOST_PLAYED) {
            $fields->add('gv.score');
        }
    }
}