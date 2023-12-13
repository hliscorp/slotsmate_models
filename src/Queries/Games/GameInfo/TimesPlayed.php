<?php

namespace Hlis\SlotsMateModels\Queries\Games\GameInfo;

use Hlis\GlobalModels\Filters\Game as GameFilter;
use Hlis\GlobalModels\Queries\Query;
use Lucinda\Query\Vendor\MySQL\Select;

class TimesPlayed extends Query
{
    protected GameFilter $filter;

    public function __construct(GameFilter $filter)
    {
        $this->filter = $filter;
        $this->query = new Select("games", "t1");
        $this->setFields();
        $this->setWhere();
    }

    protected function setFields(): void
    {
        $fields = $this->query->fields();
        $fields->add("t1.id");
        $fields->add("t1.times_played");
    }

    protected function setWhere(): void
    {
        $this->query->where()->setIn("t1.id", $this->filter->getId());
    }
}