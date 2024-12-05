<?php

namespace Hlis\SlotsMateModels\Queries\Casinos\CasinoList;

use Lucinda\Query\Clause\Fields;

class Bonuses extends \Hlis\GlobalModels\Queries\Casinos\CasinoList\Bonuses
{
    protected function setFields(Fields $fields): void
    {
        parent::setFields($fields);

        $fields->add("t1.client_id");
        $fields->add("t1.games");
        $fields->add("t1.wagering");
        $fields->add("t1.deposit_minimum");
    }
}