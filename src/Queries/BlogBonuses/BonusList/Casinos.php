<?php

namespace Hlis\SlotsMateModels\Queries\BlogBonuses\BonusList;

use Hlis\GlobalModels\Queries\BlogBonuses\BonusList\Casinos as GlobalCasinos;
use Lucinda\Query\Clause\Condition;

class Casinos extends GlobalCasinos
{
    protected function setWhere(Condition $condition, array $casinoIDs): void
    {
        parent::setWhere($condition, $casinoIDs);

        $statuses = $this->filter->getStatus();
        if ($statuses!==null) {
            $condition->setIn("t1.status_id", $statuses);
        }

        if ($this->filter->getIsOpen()) {
            $condition->set("t1.is_open", 1);
        }
    }
}
