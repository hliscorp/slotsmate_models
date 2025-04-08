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
        if($this->filter->getDepositRange() && $this->filter->getSelectedCountry()) {
            $fields->add("
                COALESCE(
                    MIN(CASE WHEN cmdc.record_id IS NOT NULL THEN cmd.value ELSE NULL END), 
                    cmd.value
                ) AS deposit_minimum");
        } else {
            $fields->add("t1.deposit_minimum");
        }
        $fields->add("(rating_total/rating_votes) AS average_rating");

        if ($this->filter->getIsLiveDealer()) {
            $fields->add("t7.is_live");
        }

        if ($this->filter->getGameTypes() || ($this->filter->getIsAllGameTypes() && $this->filter->getPageType() !== 'no-deposit-slots')) {
            $fields->add("IF(cb_fb.id IS NOT NULL,1,0) AS has_free_bonus");
            $fields->add("IF(cb_fdb.id IS NOT NULL,2,0) AS has_first_deposit_bonus");
            $fields->add("IF(cb_dd.id IS NOT NULL, REPLACE( REPLACE(REPLACE(REPLACE(cb_dd.amount, '%', ''), '£', ''), '€', ''), '$', '' ), 0) AS free_bonus_amount");
        }

        if ($this->filter->getPageType() === 'real-money-slots') {
            $fields->add("COUNT(t3.id) AS rating_votes");
            $this->filter->setCountReviews(true);
        } else {
            $fields->add("rating_votes");
        }

        if (!empty($this->filter->getBonus())) {
            $fields->add("GROUP_CONCAT(DISTINCT(t22.id)) as acceptableBonusesIds");
        }
    }
}