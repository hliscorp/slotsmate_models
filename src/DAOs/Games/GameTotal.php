<?php

namespace Hlis\SlotsMateModels\DAOs\Games;

use Hlis\SlotsMateModels\Queries\Games\GameListTotal as GameListTotalQuery;
use Hlis\GlobalModels\DAOs\Games\GameTotal as DefaultGameTotal;
use Hlis\GlobalModels\Queries\Query;

class GameTotal extends DefaultGameTotal
{
    protected function getQuery(): Query
    {
        return new GameListTotalQuery($this->filter);
    }
}