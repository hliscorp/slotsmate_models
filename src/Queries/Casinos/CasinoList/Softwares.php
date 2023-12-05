<?php

namespace Hlis\SlotsMateModels\Queries\Casinos\CasinoList;

use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Clause\Fields;
use Lucinda\Query\Select;


class Softwares extends \Hlis\GlobalModels\Queries\Query
{
    public function __construct (array $casinoIDs)
    {
        $this->query = new Select("casinos__game_manufacturers", "t1");
        $this->setFields($this->query->fields());
        $this->setJoins();
        $this->setWhere($this->query->where(), $casinoIDs);
        $this->query->orderBy()->add("t1.is_primary", \Lucinda\Query\Operator\OrderBy::DESC);
    }

    protected function setFields(Fields $fields): void
    {
        $fields->add("t1.casino_id");
        $fields->add("t2.name");
        $fields->add("t2.id");
    }

    protected function setJoins(): void
    {
        $this->query->joinInner("game_manufacturers", "t2")->on(["t1.game_manufacturer_id"=>"t2.id"]);
    }

    protected function setWhere(\Lucinda\Query\Clause\Condition $condition, array $casinoIDs): void
    {
        $condition->setIn("t1.casino_id", $casinoIDs);
    }

}