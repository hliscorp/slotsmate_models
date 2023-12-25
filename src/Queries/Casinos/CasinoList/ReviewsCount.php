<?php

namespace Hlis\SlotsMateModels\Queries\Casinos\CasinoList;

use Lucinda\Query\Clause\Fields;
use Lucinda\Query\Select;


class ReviewsCount extends \Hlis\GlobalModels\Queries\Query
{
    public function __construct (array $casinoIDs)
    {
        $this->query = new Select("casinos__reviews", "t1");
        $this->setFields($this->query->fields());
        $this->setWhere($this->query->where(), $casinoIDs);
        $this->query->groupBy(["t1.casino_id"]);
    }

    protected function setFields(Fields $fields): void
    {
        $fields->add("t1.casino_id");
        $fields->add("COUNT(t1.id)", "nr");
    }

    protected function setWhere(\Lucinda\Query\Clause\Condition $condition, array $casinoIDs): void
    {
        $condition->set("t1.comment_status", "3", "!=");
        $condition->set("t1.parent_id", "0");
        $condition->setIn("t1.casino_id", $casinoIDs);
    }

}