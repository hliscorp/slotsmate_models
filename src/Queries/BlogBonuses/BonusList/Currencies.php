<?php

namespace Hlis\SlotsMateModels\Queries\BlogBonuses\BonusList;

use Hlis\GlobalModels\Queries\Query;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Clause\Fields;
use Lucinda\Query\Select;

class Currencies extends Query
{
    public function __construct (array $bonusIDs)
    {
        $this->query = new Select("bonuses__currencies", "t1");
        $this->setFields($this->query->fields());
        $this->setJoins();
        $this->setWhere($this->query->where(), $bonusIDs);
    }

    protected function setFields(Fields $fields): void
    {
        $fields->add("t1.bonus_id");
        $fields->add("t2.id", "currency_id");
        $fields->add("t2.code", "currency_code");
        $fields->add("t2.symbol", "currency_symbol");
    }

    protected function setJoins(): void
    {
        $this->query->joinInner("currencies", "t2")->on(["t1.currency_id"=>"t2.id"]);
    }

    protected function setWhere(Condition $condition, array $bonusIDs): void
    {
        $condition->setIn("t1.bonus_id", $bonusIDs);
    }
}