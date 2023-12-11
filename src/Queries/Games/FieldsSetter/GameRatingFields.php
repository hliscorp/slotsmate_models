<?php

namespace Hlis\SlotsMateModels\Queries\Games\FieldsSetter;

use Hlis\GlobalModels\Queries\AbstractFields;
use Lucinda\Query\Clause\Fields;

class GameRatingFields extends AbstractFields
{

    public function appendFields(Fields $fields): void
    {
        $fields->add("t1.game_manufacturer_id");
        $fields->add("t2.score");
        $fields->add("COUNT(t3.rating)", "rating");
    }
}