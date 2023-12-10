<?php

namespace Hlis\SlotsMateModels\Builders\GameManufacturer;
use Hlis\SlotsMateModels\Entities\GameManufacturer as GameManufacturerEntity;
use Hlis\GlobalModels\Builders\GameManufacturer\Basic as DefaultBasic;

class Basic extends DefaultBasic
{
    public function build(array $row): \Entity
    {
        $entity = new GameManufacturerEntity();
        $entity->id = $row['id'];
        $entity->name = isset($row['unit']) ? $row['unit'] :  $row['name'];
        return $entity;
    }
}