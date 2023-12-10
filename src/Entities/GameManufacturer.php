<?php

namespace Hlis\SlotsMateModels\Entities\GameManufacturer;
use Hlis\GlobalModels\Entities\GameManufacturer as DefaultGameManufacturer;
class GameManufacturer extends DefaultGameManufacturer
{
    public ?float $gameScore = null;
    public ?int $gameRating = null;
}