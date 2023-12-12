<?php

namespace Hlis\SlotsMateModels\Builders\Game;

use Hlis\SlotsMateModels\Entities\Game as GameEntity;
use Hlis\GlobalModels\Builders\Game\Basic as GlobalBuilder;

class Search extends GlobalBuilder
{
    public function build(array $row): \Entity
    {
        $game = parent::build($row);
        $game->timesPlayed = $row["times_played"];
        $game->is_mobile = $row["is_mobile"];

        return $game;
    }

    protected function getEntity(): \Entity
    {
        return new GameEntity();
    }
}