<?php

namespace Hlis\SlotsMateModels\Builders\Casino\Info;

use Hlis\SlotsMateModels\Entities\Casino;
use Hlis\GlobalModels\Builders\Casino\Info\Detailed as GlobalDetailed;

class Detailed extends GlobalDetailed
{
    public function build(array $row): \Entity
    {
        $result = parent::build($row);
        return $result;
    }


    protected function getEntity(): \Entity
    {
        return new Casino();
    }
}