<?php

namespace Hlis\SlotsMateModels\Entities;

use Hlis\GlobalModels\Entities\GameManufacturer as DefaultGameManufacturer;

class GameManufacturer extends DefaultGameManufacturer
{
    public ?int $priority = null;
    public ?int $isLocaleSupported = null;
}