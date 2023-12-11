<?php

namespace Hlis\SlotsMateModels\Builders\Game;

use Hlis\GlobalModels\Builders\Game\Detailed as GlobalDetailedInfo;
use Hlis\GlobalModels\Builders\GameManufacturer as GameManufacturerBuilder;
use Hlis\GlobalModels\Builders\GameType as GameTypeBuilder;
use Hlis\SlotsMateModels\Entities\Game as GameEntity;

class GameInfo extends GlobalDetailedInfo
{
    public function build(array $row): GameEntity
    {
        $game = $this->getEntity();

        $game->id = $row["id"];
        $game->name = $row["name"];
        $game->dateLaunched = $row["date_launched"];
        $game->isOpen = $row["is_open"];

        $manufacturerBuilder = new GameManufacturerBuilder();
        $game->manufacturer = $manufacturerBuilder->build($row);

        $typeBuilder = new GameTypeBuilder();
        $game->type = $typeBuilder->build($row);
        $game->features = $this->compileBasicGameFeatures($row);
        $game->volatility = $this->compileVolatility($row);

        $game->timesPlayed = $row['times_played'];

        $game->is_best = $row["is_best"];
        $game->is_hot = $row["is_hot"];
        $game->is_mobile = $row["is_mobile"];

        $game->max_win_pl = $row["max_win_pl"];

        return $game;
    }

    protected function compileBasicGameFeatures(array $row): \Hlis\GlobalModels\Entities\Game\Features
    {
        $features = new \Hlis\GlobalModels\Entities\Game\Features();
        $features->paylines = $row["paylines"];
        $features->reels = $row["reels"];
        $features->minCPL = $row["min_cpl"];
        $features->maxCPL = $row["max_cpl"];
        $features->minCS = $row["min_cs"];
        $features->maxCS = $row["max_cs"];
        $features->rtp = $this->compileRtp($row);
        return $features;
    }

    protected function getEntity(): \Entity
    {
        return new GameEntity();
    }
}