<?php

namespace Hlis\SlotsMateModels\Queries\BlogBonuses\JoinsSetter;

use Hlis\GlobalModels\Queries\BlogBonuses\JoinsSetter\BonusListJoins as GlobalBonusListJoins;

class BonusListJoins extends GlobalBonusListJoins
{
    protected function setCountriesJoins(): void
    {
        if ($countryID = $this->filter->getSelectedCountry()) {
            $this->query->joinInner("bonuses__countries_allowed", "t4")->on([
                "t1.id"=>"t4.bonus_id",
                "t4.country_id"=>$countryID
            ]);
        } elseif ($countryID = $this->filter->getUserCountry()) {
            $this->query->joinLeft("bonuses__countries_allowed", "t4")->on([
                "t1.id"=>"t4.bonus_id",
                "t4.country_id"=>$countryID
            ]);
        }
    }
}