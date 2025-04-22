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

    protected function setCasinosJoins(): void
    {
        if ($casinoFilter = $this->filter->getCasinos()) {
            $this->setBonusesCasinoJoin($casinoFilter);

            new CasinoListJoins($casinoFilter, $this->query);
        }
    }

    protected function setGamesJoins(): void
    {
        if ($filter = $this->filter->getGames()) {
            $this->setBonusesGamesJoin($filter);

            new GameListJoins($filter, $this->query);
            $this->groupBy = true;
        }
    }
}
