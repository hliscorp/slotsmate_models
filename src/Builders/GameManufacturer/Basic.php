<?php

namespace Hlis\SlotsMateModels\Builders\GameManufacturer;
use Hlis\GlobalModels\Builders\GameManufacturer\Basic as DefaultBasic;

class Basic extends DefaultBasic
{
    public function build(array $row): \Entity
    {
        $entity = new \Hlis\SlotsMateModels\Entities\GameManufacturer\GameManufacturer();
        $entity->id = $row['id'];
        $entity->name = isset($row['unit']) ? $row['unit'] :  $row['name'];
        return $entity;
    }
}