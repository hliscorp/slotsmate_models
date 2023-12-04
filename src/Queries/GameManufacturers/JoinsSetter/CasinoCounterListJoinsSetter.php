<?php

namespace Hlis\SlotsMateModels\Queries\GameManufacturers\JoinsSetter;
use Hlis\GlobalModels\Queries\GameManufacturers\JoinsSetter\GameManufacturerListJoins;
class CasinoCounterListJoinsSetter extends GameManufacturerListJoins
{
    protected function appendJoins(): void
    {
        $this->setCasinoGameManufacturersJoin();
        $this->setCasinosJoin();
        $this->setCasinoLicensesJoin();
        $this->setCasinoBonusesJoin();
        $this->setCasinoCountriesJoin();
        $this->setCasinoGameTypesJoin();
    }

    protected function setCasinoGameManufacturersJoin(): void
    {
        $this->query->joinInner("casinos__game_manufacturers", "t2")->on([
            "t1.id" => "t2.game_manufacturer_id"
        ]);
    }

    protected function setCasinosJoin(): void
    {
        $this->query->joinInner("casinos", "t3")->on([
            "t2.casino_id" => "t3.id"
        ]);
    }

    protected function setCasinoLicensesJoin(): void
    {
        if ($this->filter->getLicenseId()) {
            $this->query->joinInner("casinos__licenses", "t4")->on([
                "t3.id" => "t4.casino_id"
            ]);
            $this->query->joinInner("licenses", "t5")->on([
                "t4.license_id" => "t5.id"
            ]);
        }
    }

    protected function setCasinoBonusesJoin(): void
    {
        if ($this->filter->isFreeBonus()) {
            $this->query->joinInner("casinos__bonuses", "t6")->on([
                "t2.casino_id" => "t6.casino_id"
            ]);
        }
    }

    protected function setCasinoCountriesJoin(): void
    {
        if ($this->filter->getSelectedCountry()) {
            $this->query->joinInner("casinos__countries_allowed", "t7")->on([
                "t2.casino_id" => "t7.casino_id"
            ])->set("t7.country_id", $this->filter->getSelectedCountry());
        }
    }

    protected function setCasinoGameTypesJoin(): void
    {
        if ($this->filter->getGameTypes()) {
            $this->query->joinInner("casinos__game_types", "t8")->on([
                "t2.casino_id" => "t8.casino_id"
            ])->setIn("t8.game_type_id", $this->filter->getGameTypes())->set("t8.is_live", 1);
        }
    }

}