<?php

namespace Hlis\SlotsMateModels\Builders\GameManufacturer;

use Hlis\SlotsMateModels\Entities\GameManufacturer;
use Hlis\GlobalModels\Builders\GameManufacturer\Basic as DefaultBasic;

class Basic extends DefaultBasic
{
    public function build(array $row): \Entity
    {
        $entity = new GameManufacturer();
        $entity->id = $row['id'];
        $entity->name = $row['name'];
        $entity->priority = $row['priority']??null;
        $entity->isLocaleSupported = $row["isLocaleSupported"]??null;
        $entity->isAllowedByUserCountry = $row["is_allowed"]??null;
        return $entity;
    }
}