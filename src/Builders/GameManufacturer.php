<?php

namespace Hlis\SlotsMateModels\Builders;

use Hlis\SlotsMateModels\Entities\GameManufacturer as GameManufacturerEntity;

class GameManufacturer extends \Hlis\GlobalModels\Builders\GameManufacturer
{

    public function build(array $row): \Entity
    {
       $entity = parent::build($row);
       $entity->softwareLocaleSupported = $row['softwareLocaleSupported'];

       return $entity;
    }

    protected function getEntity(): \Entity
    {
        return new GameManufacturerEntity();
    }
}