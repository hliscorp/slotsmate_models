<?php

namespace Hlis\SlotsMateModels\Builders\BlogBonuses;

use Hlis\GlobalModels\Builders\BlogBonus\Basic as GlobalBasic;
use Hlis\GlobalModels\Entities\BlogBonus\Features;
use Hlis\SlotsMateModels\Entities\BlogBonus;

class Basic extends GlobalBasic
{
    public function build(array $row): \Entity
    {
        $object = parent::build($row);
        $object->isBonusAllowedByUserCountry = (bool) $row["is_allowed_by_user_country"]??0;
        return $object;
    }

    protected function getFeatures(array $row): Features
    {
        $object = parent::getFeatures($row);
        $object->isDepositMinimumUnknown = (bool) $row["unknown_minimum_deposit"];
        return $object;
    }

    protected function getEntity(): \Entity
    {
        return new BlogBonus();
    }
}