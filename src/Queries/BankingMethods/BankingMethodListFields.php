<?php

namespace Hlis\SlotsMateModels\Queries\BankingMethods;

use Hlis\GlobalModels\Queries\AbstractFields;
use Lucinda\Query\Clause\Fields;

class BankingMethodListFields extends AbstractFields
{
    public function appendFields(Fields $fields): void
    {
        $fields->add("t1.id");
        $fields->add("t1.name");
        if ($this->filter->getIsOpen()) {
            $fields->add("is_open");
        }
    }
}