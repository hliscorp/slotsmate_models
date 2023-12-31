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
        if ($this->filter->getHasOpenCasinos()) {
            $fields->add("COUNT(DISTINCT t4.casino_id)", 'counter');
        }
        if ($this->filter->getHasLatestDateUpdated()) {
            $fields->add("MAX(t5.date)", "date_updated");
        }
    }
}