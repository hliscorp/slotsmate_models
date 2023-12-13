<?php

namespace Hlis\SlotsMateModels\DAOs\Games;

use Hlis\SlotsMateModels\Builders\Game\Search as GameBuilder;
use Hlis\SlotsMateModels\Queries\Games\GamesSearch as GameSearchQuery;

class GameSearch extends GameList
{
    protected function createTrunks(): void
    {
        $builder = new GameBuilder();
        $querier = new GameSearchQuery($this->filter, $this->orderByAlias, $this->limit, $this->offset);
        $resultSet = \SQL($querier->getQuery(), $querier->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entities[] = $builder->build($row);
        }
    }

    protected function appendBranches(array $ids): void {
        $this->appendTimesPlayed($ids);
    }

    protected function appendTimesPlayed($ids)
    {
        $query = new \Hlis\SlotsMateModels\Queries\Games\GameList\TimesPlayed($ids);
        $resultSet = \SQL($query->getQuery(), $query->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entities[$row["id"]]->timesPlayed = $row["times_played"];
        }
    }
}