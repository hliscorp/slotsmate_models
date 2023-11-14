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
        if ($this->filter->getHasOpenCasinos()) {
            $fields->add("COUNT(t4.casino_id)", "counter");
        }
        if ($this->filter->getHasLatestDateUpdated()) {
            $fields->add("MAX(t5.date)", "date_updated");
        }
        if ($this->filter->getMethodRestrictedInCountry()) {
            $fields->add("t9.is_allowed", "is_allowed");
        }
    }
}