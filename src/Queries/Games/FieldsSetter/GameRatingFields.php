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
        $fields->add("IF(t3.game_id IS NULL, 0, count(t3.rating))", "rating");
    }
}