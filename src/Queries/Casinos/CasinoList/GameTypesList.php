<?php

namespace Hlis\SlotsMateModels\Queries\Casinos\CasinoList;

use Lucinda\Query\Clause\Fields;
use Lucinda\Query\Select;


class GameTypesList extends \Hlis\GlobalModels\Queries\Query
{
    public function __construct ()
    {
        $this->query = new Select("game_types", "t1");
        $this->setFields($this->query->fields());
        $this->setWhere($this->query->where());
        $this->query->orderBy()->add("t1.priority");
    }

    protected function setFields(Fields $fields): void
    {
        $fields->add("t1.name");
    }


    protected function setWhere(\Lucinda\Query\Clause\Condition $condition): void
    {
        $condition->set("t1.name", '"Other"', '!=');
        $condition->set("t1.name", '"Video Slots"', '!=');
    }

}