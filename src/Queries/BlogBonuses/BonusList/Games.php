<?php

namespace Hlis\SlotsMateModels\Queries\BlogBonuses\BonusList;

use Hlis\GlobalModels\Queries\BlogBonuses\BonusList\Games as GlobalGames;
use Lucinda\Query\Clause\Fields;

class Games extends GlobalGames
{
    protected function setFields(Fields $fields): void
    {
        $fields->add("t1.bonus_id");
        $fields->add("t2.id");
        $fields->add("t2.name");
        $fields->add("t2.date_launched");
        $fields->add("t3.id", "game_manufacturer_id");
        $fields->add("t3.name", "game_manufacturer_name");
    }

    protected function setJoins(): void
    {
        $this->query->joinInner("games", "t2")->on(["t1.game_id"=>"t2.id"]);
        $this->query->joinInner('game_manufacturers', 't3')->on(['t2.game_manufacturer_id' => 't3.id']);
    }
}