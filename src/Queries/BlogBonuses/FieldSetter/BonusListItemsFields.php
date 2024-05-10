<?php

namespace Hlis\SlotsMateModels\Queries\BlogBonuses\FieldSetter;

use Hlis\GlobalModels\Queries\BlogBonuses\FieldSetter\BonusListItemsFields as GlobalBonusListItemsFields;
use Lucinda\Query\Clause\Fields;

class BonusListItemsFields extends GlobalBonusListItemsFields
{
    public function appendFields(Fields $fields): void
    {
        parent::appendFields($fields);
        $fields->add("t1.unknown_minimum_deposit");
        if ($this->filter->getSelectedCountry() || $this->filter->getUserCountry()) {
            $fields->add(
                "IF(t4.id IS NOT NULL,1,0)",
                "is_allowed_by_user_country"
            );
        }
    }
}