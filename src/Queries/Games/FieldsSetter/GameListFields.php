<?php

namespace Hlis\SlotsMateModels\Queries\Games\FieldsSetter;

use Hlis\GlobalModels\Queries\Games\FieldsSetter\GameListFields as GameListFieldsGlobal;
use Lucinda\Query\Clause\Fields;

class GameListFields extends GameListFieldsGlobal
{
    public function appendFields(Fields $fields): void
    {
        parent::appendFields($fields);
        $fields->add('t1.times_played');
        $fields->add('t1.rtp');
        $fields->add('t1.is_best');
        $fields->add('t1.is_hot');
        $fields->add('t1.is_mobile');
        $fields->add('gv.score');
        if ($this->filter->getPageEntity() == 'Best') {
            $fields->add('COUNT( gvs.game_id)');
        }
    }
}