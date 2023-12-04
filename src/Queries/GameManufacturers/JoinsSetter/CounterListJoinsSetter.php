<?php

namespace Hlis\SlotsMateModels\Queries\GameManufacturers\JoinsSetter;
use Hlis\GlobalModels\Queries\GameManufacturers\JoinsSetter\GameManufacturerListJoins;
class CounterListJoinsSetter extends GameManufacturerListJoins
{
    protected function appendJoins(): void
    {
        $this->setGamesJoin();
        if ($this->filter->getIsCountryAccepted()) {
            $this->setCountryAccceptedJoin();
        } else {
            $this->setIsLiveJoin();
            $this->setGameVotesJoin();
            $this->setGameFeaturesJoin();
            $this->setCasinoGameTypesJoin();
        }

    }

    protected function setGamesJoin(): void
    {
        $this->query->joinInner("games", "t2")->on([
            "t1.id" => "t2.game_manufacturer_id"
        ]);
    }

    protected function setCountryAccceptedJoin() {
        $this->query->joinLeft('game_manufacturers__countries', 't7')->on(["t1.id" => "t7.game_manufacturer_id"])->set("t7.country_id", $this->filter->getSelectedCountry());
    }

    protected function setIsLiveJoin(): void
    {
        if ($this->filter->getIsLive()) {
            $this->query->joinInner("game_types", "t3")->on([
                "t2.game_type_id" => "t3.id"
            ]);
        }
    }

    protected function setGameVotesJoin(): void
    {
        if ($this->filter->getVotes()) {
            $this->query->joinLeft("game_votes", "t4")->on([
                "t2.id" => "t4.game_id"
            ]);
        }
    }

    protected function setGameFeaturesJoin(): void {
        if ($this->filter->getFeatures()) {
            $this->query->joinInner("games__features", 't5')->on(["t2.id"=>"t5.game_id"]);
        }
    }

    protected function setCasinoGameTypesJoin() {
        if ($this->filter->getIsLive()) {
            $this->query->joinInner('casinos__game_types', 't6')->on(["t3.id" => "t6.game_type_id"]);
        }
    }


}