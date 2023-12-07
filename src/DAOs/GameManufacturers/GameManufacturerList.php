<?php

namespace Hlis\SlotsMateModels\DAOs\GameManufacturers;
use Hlis\SlotsMateModels\Builders\GameManufacturer\Basic as GameManufacturerBuilder;
use Hlis\GlobalModels\DAOs\GameManufacturers\GameManufacturerList as GlobalGameManufacturerList;
use Hlis\SlotsMateModels\Queries\GameManufacturers\GameManufacturersListItems as GameManufacturerCounterListQuery;

class GameManufacturerList extends GlobalGameManufacturerList
{
    protected function createTrunks(): void
    {
        $builder = new GameManufacturerBuilder();
        $querier = new GameManufacturerCounterListQuery($this->filter, $this->orderByAlias, $this->limit, $this->offset);
        echo $querier->getQuery();
        $resultSet = \SQL($querier->getQuery(), $querier->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entities[$row["id"]] = $builder->build($row);
        }
    }
}