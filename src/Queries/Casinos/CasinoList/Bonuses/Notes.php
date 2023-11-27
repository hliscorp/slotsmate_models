<?php

namespace Hlis\SlotsMateModels\Queries\Casinos\CasinoList\Bonuses;

use Hlis\GlobalModels\Queries\Query;
use Lucinda\Query\Clause\Fields;

class Notes extends Query
{
    public function __construct(array $ids)
    {
        $this->query = new \Lucinda\Query\Select("casinos__bonuses_notes", "t1");
        $this->setFields($this->query->fields());
        $this->query->joinInner("languages", "t2")->on(["t1.language_id"=>"t2.id"]);
        $this->query->where()->setIn("t1.casino_bonus_id", $ids);
    }

    private function setFields(Fields $fields): void
    {
        $fields->add("t1.casino_bonus_id");
        $fields->add("t1.note", "value");
        $fields->add("t1.language_id");
        $fields->add("t2.name", "language_name");
        $fields->add("t2.code", "language_code");
    }
}
