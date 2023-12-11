<?php

namespace Hlis\SlotsMateModels\Queries\Casinos;

use Hlis\GlobalModels\Queries\Casinos\CasinoInfo as GlobalCasinoInfo;
use Lucinda\Query\Clause\Fields;

class CasinoInfo extends GlobalCasinoInfo
{
    public function setFields(Fields $fields): void
    {
        parent::setFields($fields);

        if ($this->filter->getIsLiveDealer()) {
            $fields->add("t7.is_live");
        }
    }

    public function setJoins(): void
    {
        parent::setJoins();
    }
}