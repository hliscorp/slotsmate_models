<?php

namespace Hlis\SlotsMateModels\Builders;

use Hlis\GlobalModels\Builders\GameType as DefaultGameType;
use Hlis\SlotsMateModels\Entities\Game\Type as GameTypeEntity;

class GameType extends DefaultGameType
{
    public function build(array $row): \Entity
    {
        $manufacturer = new GameTypeEntity();
        $manufacturer->id = $row['game_type_id'];
        $manufacturer->name = $row['game_type_name'];
        $manufacturer->isRegular = $row['is_regular'];
        $manufacturer->isLive = $row['is_live'];
        $manufacturer->isVR = $row['is_vr'];
        return $manufacturer;
    }
}