<?php

namespace Hlis\SlotsMateModels\DAOs\GameManufacturers;
use Hlis\SlotsMateModels\Builders\GameManufacturer\Basic as GameManufacturerBuilder;
use Hlis\GlobalModels\DAOs\GameManufacturers\GameManufacturerList as GlobalGameManufacturerList;
use Hlis\SlotsMateModels\Queries\GameManufacturers\GameManufacturersCounterListItems as GameManufacturerCounterListQuery;

class GameManufacturerCounterList extends GlobalGameManufacturerList
{
    protected function createTrunks(): void
    {
        $builder = new GameManufacturerBuilder();
        $querier = new GameManufacturerCounterListQuery($this->filter, $this->orderByAlias, $this->limit, $this->offset);
        $resultSet = \SQL($querier->getQuery(), $querier->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entities[$row["id"]] = $builder->build($row);
        }
    }
}