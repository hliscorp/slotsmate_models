<?php

namespace Hlis\SlotsMateModels\Queries\BankingMethods\Total;

use Hlis\GlobalModels\Queries\AbstractFields;
use Lucinda\Query\Clause\Fields;

class BankingMethodListTotalFields extends AbstractFields
{
    public function appendFields(Fields $fields): void
    {
        $fields->add("COUNT(DISTINCT t1.id)");
    }
}