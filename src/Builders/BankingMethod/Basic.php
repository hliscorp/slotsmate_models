<?php

namespace Hlis\SlotsMateModels\Builders\BankingMethod;

use Hlis\SlotsMateModels\Entities\BankingMethod;
use Hlis\GlobalModels\Builders\BankingMethod\Basic as DefaultBasic;

class Basic extends DefaultBasic
{
    public function build(array $row): \Entity
    {
        $entity = new BankingMethod();
        $entity->id = $row['id'];
        $entity->name = $row['name'];
        $entity->dateUpdated = ($row['date_updated']??"");
        $entity->isAllowedByUserCountry = $row["is_allowed"]??null;
        $entity->bankingLocaleSupported = isset($row['is_locale']) ? $row['is_locale'] :  0;
        $entity->localBankingMethodEnabled = (boolean)isset($row['is_locale_allowed']) ? $row['is_locale_allowed'] : 0;
        return $entity;
    }
}
