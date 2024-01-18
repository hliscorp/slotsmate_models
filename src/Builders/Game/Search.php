<?php

namespace Hlis\SlotsMateModels\Builders\Game;

use Hlis\SlotsMateModels\Builders\GameManufacturer as GameManufacturerBuilder;
use Hlis\SlotsMateModels\Entities\Game as GameEntity;
use Hlis\GlobalModels\Builders\Game\Basic as GlobalBuilder;

class Search extends GlobalBuilder
{
    public function build(array $row): \Entity
    {
        $game = parent::build($row);
        $game->is_mobile = $row["is_mobile"];

        $manufacturerBuilder = new GameManufacturerBuilder();
        $game->manufacturer = $manufacturerBuilder->build($row);

        return $game;
    }

    protected function getEntity(): \Entity
    {
        return new GameEntity();
    }
}