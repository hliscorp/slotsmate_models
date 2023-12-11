<?php

namespace Hlis\SlotsMateModels\Builders\Game;

use Hlis\SlotsMateModels\Entities\Game\Game as GameEntity;
use Hlis\GlobalModels\Builders\Game\Basic as GlobalBuilder;

class GameList extends GlobalBuilder
{
    public function build(array $row): \Entity
    {
        $game = parent::build($row);
        $game->timesPlayed = $row["times_played"];
        $game->rtp = $row["rtp"];
        $game->is_best = $row["is_best"];
        $game->is_hot = $row["is_hot"];
        $game->score = $row["score"];
        $game->is_mobile = $row["is_mobile"];

        return $game;
    }

    protected function getEntity(): \Entity
    {
        return new GameEntity();
    }
}