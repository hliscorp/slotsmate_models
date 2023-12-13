<?php

namespace Hlis\SlotsMateModels\Builders\Game;

use Hlis\SlotsMateModels\Entities\Game as GameEntity;
use Hlis\GlobalModels\Builders\Game\Basic as GlobalBuilder;

class GameList extends GlobalBuilder
{
    public function build(array $row): \Entity
    {
        $game = parent::build($row);
        $game->is_best = $row["is_best"];
        $game->is_hot = $row["is_hot"];
        $game->is_mobile = $row["is_mobile"];

        return $game;
    }

    protected function getEntity(): \Entity
    {
        return new GameEntity();
    }
}