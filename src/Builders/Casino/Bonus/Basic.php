<?php

namespace Hlis\SlotsMateModels\Builders\Casino\Bonus;

use Hlis\GlobalModels\Builders\BonusType as BonusTypeBuilder;
use Hlis\GlobalModels\Builders\Casino\Bonus\Basic as DefaultBasic;
use Hlis\SlotsMateModels\Entities\Casino\Bonus as CasinoBonusEntity;

class Basic extends DefaultBasic
{
    public function build(array $row): \Entity
    {
        $builder = new BonusTypeBuilder();

        $bonus = new CasinoBonusEntity();
        $bonus->type = $builder->build($row);
        $bonus->amount = $row["amount"];
        $bonus->code = $row["codes"];
        $bonus->clientId = $row["client_id"];
        $bonus->games = $row["games"];
        $bonus->wagering = $row["wagering"];
        $bonus->depositMinimum = $row["deposit_minimum"];
        $bonus->id = $row["id"];

        return $bonus;
    }
}