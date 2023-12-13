<?php

namespace Hlis\SlotsMateModels\Queries\Games\GameList;

use Lucinda\Query\Clause\Fields;
use Lucinda\Query\Select;


class TimesPlayed extends \Hlis\GlobalModels\Queries\Query
{
    public function __construct (array $gameIDs)
    {
        $this->query = new Select("games", "t1");
        $this->setFields($this->query->fields());
        $this->setWhere($this->query->where(), $gameIDs);
    }

    protected function setFields(Fields $fields): void
    {
        $fields->add("t1.id");
        $fields->add("t1.times_played");
    }

    protected function setWhere(\Lucinda\Query\Clause\Condition $condition, array $gameIDs): void
    {
        $condition->setIn("t1.id", $gameIDs);
    }
}