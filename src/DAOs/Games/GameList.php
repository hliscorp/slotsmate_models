<?php

namespace Hlis\SlotsMateModels\DAOs\Games;

use Hlis\SlotsMateModels\Builders\Game\GameList as GameListBuilder;
use Hlis\GlobalModels\DAOs\Games\GameList as GlobalGameList;
use Hlis\SlotsMateModels\Queries\Games\GamesList as GamesListQuery;

class GameList extends GlobalGameList
{
    protected function createTrunks(): void
    {
        $builder = new GameListBuilder();
        $querier = new GamesListQuery($this->filter, $this->orderByAlias, $this->limit, $this->offset);
        $resultSet = SQL($querier->getQuery(), $querier->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entities[$row["id"]] = $builder->build($row);
        }
    }

    protected function appendBranches(array $ids): void
    {
        $this->appendTimesPlayed($ids);
        $this->appendGameVotes($ids);
    }

    protected function appendTimesPlayed($ids)
    {
        $query = new \Hlis\SlotsMateModels\Queries\Games\GameList\TimesPlayed($ids);
        $resultSet = \SQL($query->getQuery(), $query->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entities[$row["id"]]->timesPlayed = $row["times_played"];
        }
    }

    protected function appendGameVotes($ids)
    {
        $query = new \Hlis\SlotsMateModels\Queries\Games\GameList\GameVotes($ids);
        $resultSet = \SQL($query->getQuery(), $query->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entities[$row["game_id"]]->score = $row["score"];
        }
    }
}