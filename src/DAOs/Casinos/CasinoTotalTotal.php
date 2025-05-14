<?php

namespace Hlis\SlotsMateModels\DAOs\Casinos;

use Hlis\SlotsMateModels\Queries\Casinos\CasinoListTotal as CasinoListQuery;
use Hlis\GlobalModels\DAOs\Casinos\CasinoTotal as DefaultCasinoTotal;
use Hlis\GlobalModels\Queries\Query;

class CasinoTotalTotal extends DefaultCasinoTotal
{
    protected function getQuery(): Query
    {
        return new CasinoListQuery($this->filter);
    }

    protected function setTotal(): void
    {
        $querier = $this->getQuery();
        $query = 'SELECT COUNT(*) AS total FROM (' . $querier->getQuery() . ') as cnt';
        $this->total = (int) \SQL($query, $querier->getParameters())->toValue();
    }
}