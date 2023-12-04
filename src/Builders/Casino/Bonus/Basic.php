<?php

namespace Hlis\SlotsMateModels\Builders\Casino\Bonus;

use Hlis\GlobalModels\Builders\Casino\Bonus\Basic as DefaultBasic;

class Basic extends DefaultBasic
{
    public function build(array $row): \Entity
    {
        $object = parent::build($row);
        $object->games = $row["games"];
        $object->wagering = $row["wagering"];
        $object->depositMinimum = $row["deposit_minimum"];
        $object->id = $row["id"];
        return $object;
    }
}