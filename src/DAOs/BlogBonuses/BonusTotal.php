<?php

namespace Hlis\SlotsMateModels\DAOs\BlogBonuses;

use Hlis\GlobalModels\DAOs\BlogBonuses\BonusTotal as GlobalBonusTotal;
use Hlis\SlotsMateModels\Queries\BlogBonuses\BonusListTotal as BonusListTotalQuery;
use Hlis\GlobalModels\Queries\Query;

class BonusTotal extends GlobalBonusTotal
{
    protected function getQuery(): Query
    {
        return new BonusListTotalQuery($this->filter);
    }
}
