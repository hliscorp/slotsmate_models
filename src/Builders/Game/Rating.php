<?php

namespace Hlis\SlotsMateModels\Builders\Game;

use Hlis\GlobalModels\Builders\Game\Basic as GlobalBuilder;

class Rating extends GlobalBuilder
{
    public function build(array $row): \Entity
    {
        $game = $this->getEntity();
        $game->score = $row["score"];
        $game->rating = $row["rating"];
        return $game;
    }
}