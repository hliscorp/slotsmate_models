<?php

namespace Hlis\SlotsMateModels\Queries\Casinos\CasinoList\Bonuses;

use Hlis\GlobalModels\Queries\Query;
use Lucinda\Query\Clause\Fields;

class Countries extends Query
{
    public function __construct(array $ids)
    {
        $this->query = new \Lucinda\Query\Select("casinos__bonuses_countries", "t1");
        $this->setFields($this->query->fields());
        $this->query->joinInner("countries", "t2")->on(["t1.country_id"=>"t2.id"]);
        // could not understand what that shit is needed, its not working properly
        //$this->query->joinInner("locale__countries", "lc")->on(["lc.country_id"=>"t2.id"]);
        $this->query->where()->setIn("t1.casino_bonus_id", $ids);
    }

    private function setFields(Fields $fields): void
    {
        $fields->add("t1.casino_bonus_id");
        $fields->add("t1.is_allowed");
        $fields->add("t1.country_id");
        $fields->add("t2.name", "country_name");
        $fields->add("t2.code", "country_code");
    }
}
