<?php

namespace Hlis\SlotsMateModels\DAOs\GameManufacturers;

use Hlis\GlobalModels\DAOs\GameManufacturers\GameManufacturerTotal as GlobalGameManufacturerTotal;
use Hlis\SlotsMateModels\Queries\GameManufacturers\GameManufacturerListTotal;
use Hlis\GlobalModels\Queries\Query;

class GameManufacturerTotal extends GlobalGameManufacturerTotal
{
    protected function getQuery(): Query
    {
        return new GameManufacturerListTotal($this->filter);
    }
}