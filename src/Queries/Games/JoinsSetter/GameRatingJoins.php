<?php

namespace Hlis\SlotsMateModels\Queries\Games\JoinsSetter;

use Hlis\GlobalModels\Queries\Games\JoinsSetter\GameInfoJoins as GlobalJoins;

class GameRatingJoins extends GlobalJoins
{
    protected function appendJoins(): void
    {
        $this->appendGameRatingJoins();
    }

    protected function appendGameRatingJoins(): void
    {
        $this->query->joinLeft("games__votes", "t2")->on(["t1.id"=>"t2.game_id"]);
        $this->query->joinLeft("games__votes_statistics", "t3")->on(["t1.id"=>"t3.game_id"]);
    }
}