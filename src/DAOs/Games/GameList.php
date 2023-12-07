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
}