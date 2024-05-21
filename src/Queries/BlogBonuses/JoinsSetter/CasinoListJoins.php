<?php

namespace Hlis\SlotsMateModels\Queries\BlogBonuses\JoinsSetter;

use Hlis\GlobalModels\Queries\BlogBonuses\JoinsSetter\CasinoListJoins as GlobalCasinoListJoins;

class CasinoListJoins extends GlobalCasinoListJoins
{
    protected function appendJoins(): void
    {
        $this->setCasinosJoin();
    }
}
