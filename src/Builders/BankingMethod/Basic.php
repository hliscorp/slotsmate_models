<?php

namespace Hlis\SlotsmateModels\Builders\BankingMethod;

use Hlis\SlotsmateModels\Entities\BankingMethod;
use Hlis\GlobalModels\Builders\BankingMethod\Basic as DefaultBasic;

class Basic extends DefaultBasic
{
    public function build(array $row): \Entity
    {
        $entity = new BankingMethod();
        $entity->id = $row['id'];
        $entity->name = $row['name'];
        $entity->dateUpdated = ($row['date_updated']??"");
        $entity->isLocaleSupported = $row["isLocaleSupported"]??null;
        $entity->isAllowedByUserCountry = $row["is_allowed"]??null;
        return $entity;
    }
}
