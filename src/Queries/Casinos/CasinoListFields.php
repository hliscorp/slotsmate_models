<?php

namespace Hlis\SlotsMateModels\Queries\Casinos;

use Hlis\GlobalModels\Queries\Casinos\FieldsSetter\CasinoListItemsFields as DefaultCasinoListItemsFields;
use Lucinda\Query\Clause\Fields;

class CasinoListFields extends DefaultCasinoListItemsFields
{
    public function appendFields(Fields $fields): void
    {
        parent::appendFields($fields);

        $fields->add("t1.date_established");
        $fields->add("t1.withdraw_minimum");
        $fields->add("t1.deposit_minimum");

        if ($this->filter->getIsLiveDealer()) {
            $fields->add("t7.is_live");
        }

        if ($this->filter->getGameTypes() || ($this->filter->getIsAllGameTypes() && $this->filter->getPageType() !== 'no-deposit-slots')) {
            $fields->add("IF(cb_fdb.id IS NOT NULL,2,0) AS has_first_deposit_bonus");
            $fields->add("IF(cb_dd.id IS NOT NULL, REPLACE( REPLACE(REPLACE(REPLACE(cb_dd.amount, '%', ''), '£', ''), '€', ''), '$', '' ), 0) AS free_bonus_amount");
        }

        if (!empty($this->filter->getBonus())) {
            $fields->add("GROUP_CONCAT(DISTINCT(t22.id)) as acceptableBonusesIds");
        }
    }
}