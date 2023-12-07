<?php

namespace Hlis\SlotsMateModels\Builders\GameManufacturer;

use Hlis\GlobalModels\Entities\GameManufacturer;
use Hlis\GlobalModels\Builders\GameManufacturer\Basic as DefaultBasic;

class Basic extends DefaultBasic
{
    public function build(array $row): \Entity
    {
        $entity = new GameManufacturer();
        $entity->id = $row['id'];
        $entity->name = $row['unit'];
        return $entity;
    }
}