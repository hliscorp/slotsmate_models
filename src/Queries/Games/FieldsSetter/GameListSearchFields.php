<?php

namespace Hlis\SlotsMateModels\Queries\Games\FieldsSetter;

use Hlis\GlobalModels\Queries\Games\FieldsSetter\GameListFields as GameListFieldsGlobal;
use Lucinda\Query\Clause\Fields;

class GameListSearchFields extends GameListFieldsGlobal
{
    public function appendFields(Fields $fields): void
    {
        parent::appendFields($fields);
        $fields->add('t1.times_played');
        $fields->add('t1.is_mobile');
    }
}