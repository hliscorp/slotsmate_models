<?php

namespace Hlis\SlotsMateModels\Builders\GameManufacturer;

use Hlis\GlobalModels\Builders\GameManufacturer\Basic as DefaultBasic;
use Hlis\SlotsMateModels\Entities\GameManufacturer;

class Basic extends DefaultBasic
{
    public function build(array $row): \Entity
    {
        $entity = new GameManufacturer();
        $entity->id = $row['id'];
        $entity->name = isset($row['unit']) ? $row['unit'] :  $row['name'];
        $entity->softwareLocaleSupported = isset($row['softwareLocaleSupported']) ? $row['softwareLocaleSupported'] :  0;

        return $entity;
    }
}