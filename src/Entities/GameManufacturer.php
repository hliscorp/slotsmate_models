<?php

namespace Hlis\SlotsMateModels\Entities;
use Hlis\GlobalModels\Entities\GameManufacturer as DefaultGameManufacturer;
class GameManufacturer extends DefaultGameManufacturer
{
    public ?float $gameScore = null;
    public ?int $gameRating = null;
    public ?int $softwareLocaleSupported = null;
}