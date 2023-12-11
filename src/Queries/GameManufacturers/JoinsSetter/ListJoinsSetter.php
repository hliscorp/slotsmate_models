<?php

namespace Hlis\SlotsMateModels\Queries\GameManufacturers\JoinsSetter;
use Hlis\GlobalModels\Queries\GameManufacturers\JoinsSetter\GameManufacturerListJoins;
class ListJoinsSetter extends GameManufacturerListJoins
{
    protected function appendJoins(): void
    {
        parent::appendJoins();
        $this->setGamesJoin();
    }

    protected function setSelectedCountryJoin() : void {
        if ($this->filter->getSelectedCountry()) {
            $this->query->joinLeft("game_manufacturers__countries", "t3")->on([
                "t1.id" => "t3.game_manufacturer_id"
            ])->set(
                "t3.country_id",$this->filter->getSelectedCountry()
            );
        }
    }

    protected function setGamesJoin(): void
    {
        $this->query->joinInner("games", "t2")->on([
            "t1.id" => "t2.game_manufacturer_id"
        ]);
    }

}