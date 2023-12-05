<?php

namespace Hlis\SlotsMateModels\Queries\Casinos\CasinoList;

use Lucinda\Query\Clause\Fields;
use Lucinda\Query\Select;


class GameTypes extends \Hlis\GlobalModels\Queries\Query
{
    public function __construct (array $casinoIDs)
    {
        $this->query = new Select("casinos__game_types", "t1");
        $this->setFields($this->query->fields());
        $this->setJoins();
        $this->setWhere($this->query->where(), $casinoIDs);
        $this->query->orderBy()->add("t2.priority");
    }

    protected function setFields(Fields $fields): void
    {
        $fields->add("t1.casino_id");
        $fields->add("t1.is_regular");
        $fields->add("t1.is_live");
        $fields->add("t1.is_vr");
        $fields->add("t2.name", "game_type_name");
        $fields->add("t2.id", "game_type_id");

    }

    protected function setJoins(): void
    {
        $this->query->joinInner("game_types", "t2")->on(["t1.game_type_id"=>"t2.id"]);
    }

    protected function setWhere(\Lucinda\Query\Clause\Condition $condition, array $casinoIDs): void
    {
        $condition->setIn("t1.casino_id", $casinoIDs);
    }

}