<?php

namespace Hlis\SlotsMateModels\DAOs\GameManufacturers;
use Hlis\GlobalModels\Entities\Game\Features;
use Hlis\GlobalModels\Entities\Game\Rtp;
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
        $querier = new GameRating($this->filter);
        $resultSet = SQL($querier->getQuery(), $querier->getParameters());
        while ($row = $resultSet->toRow()) {
            $game = new Game();
            $game->timesPlayed = $row["times_played"];
            $game->dateLaunched = $row["date_launched"];
            $game->name = $row["name"];
            $game->score = $row["score"];
            $game->rating = $row["rating"];
            $game->features = new Features();
            $game->features->rtp = new Rtp();
            $game->features->rtp->value = $row["rtp"];
            $this->entities[$row["id"]]->games[] = $game;
        }
    }
}