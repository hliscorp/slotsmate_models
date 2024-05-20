<?php

namespace Hlis\SlotsMateModels\DAOs\BlogBonuses\BonusList;

use Hlis\GlobalModels\DAOs\BlogBonuses\BonusList\Casinos as GlobalCasinos;
use Hlis\GlobalModels\Queries\BlogBonuses\BonusList\Casinos as GlobalCasinosQuery;
use Hlis\SlotsMateModels\Queries\BlogBonuses\BonusList\Casinos as CasinosQuery;

class Casinos extends GlobalCasinos
{
    protected function getQueryClass(array $casinos): GlobalCasinosQuery
    {
        return new CasinosQuery($casinos, $this->filter);
    }
}
