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

    protected function appendBonuses(array $casinoIDs): void {}

    protected function appendBranches(array $ids): void {}
}