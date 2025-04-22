<?php

namespace Hlis\SlotsMateModels\Queries\BlogBonuses\JoinsSetter;

class GameListJoins extends \Hlis\GlobalModels\Queries\BlogBonuses\JoinsSetter\GameListJoins
{
    protected function appendJoins(): void
    {
        $this->setGamesJoin();
    }
}