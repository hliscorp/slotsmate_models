<?php

namespace Hlis\SlotsMateModels\DAOs\Casinos;

use Hlis\SlotsMateModels\Queries\Casinos\CasinoListTotal as CasinoListQuery;
use Hlis\GlobalModels\DAOs\Casinos\CasinoTotal as DefaultCasinoTotal;
use Hlis\GlobalModels\Queries\Query;

class CasinoTotal extends DefaultCasinoTotal
{
    protected function getQuery(): Query
    {
        return new CasinoListQuery($this->filter);
    }
}