<?php

namespace Hlis\SlotsMateModels\DAOs\GameManufacturers;
use Hlis\GlobalModels\Entities\Game\Features;
use Hlis\GlobalModels\Entities\Game\Rtp;
use Hlis\SlotsMateModels\Builders\Game\Rating;
use Hlis\SlotsMateModels\Builders\GameManufacturer\Basic as GameManufacturerBuilder;
use Hlis\GlobalModels\DAOs\GameManufacturers\GameManufacturerList as GlobalGameManufacturerList;
use Hlis\SlotsMateModels\Entities\Game\Game;
use Hlis\SlotsMateModels\Queries\GameManufacturers\GameManufacturersListItems as GameManufacturerCounterListQuery;
use Hlis\SlotsMateModels\Queries\Games\GameRating;

class GameManufacturerList extends GlobalGameManufacturerList
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

    protected function appendBranches(array $ids): void
    {
        foreach ($ids as $id) {
            $this->filter->addId($id);
        }
        $builder = new Rating();
        $querier = new GameRating($this->filter);
        $resultSet = SQL($querier->getQuery(), $querier->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entities[$row["game_manufacturer_id"]]->games[] = $builder->build($row);
        }
    }
}