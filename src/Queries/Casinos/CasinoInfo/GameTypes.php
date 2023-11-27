<?php

namespace Hlis\SlotsMateModels\Queries\Casinos\CasinoInfo;

use Hlis\GlobalModels\Queries\Casinos\CasinoInfo\GameTypes as DefaultGameTypes;
use Lucinda\Query\Clause\Fields;

class GameTypes extends DefaultGameTypes
{
    protected function setFields(Fields $fields): void
    {
        parent::setFields($fields);

        $fields->add("t1.is_regular");
        $fields->add("t1.is_live");
        $fields->add("t1.is_vr");
    }
}