<?php

namespace Hlis\SlotsMateModels\Queries\Casinos\CasinoList;

use Hlis\GlobalModels\Queries\Query;
use Lucinda\Query\Clause\Fields;
use Lucinda\Query\Select;

class Languages extends Query
{
    public function __construct(array $casinoIDs)
    {
        $this->query = new Select("casinos__languages", "c_l");
        $this->setFields($this->query->fields());
        $this->query->joinInner("languages", "la")->on(["c_l.language_id" => "la.id"]);
        $this->query->where()->setIn("c_l.id", $casinoIDs);
    }

    protected function setJoins(): void
    {
        $this->query->joinInner("languages", "la")->on(["c_l.language_id" => "la.id"]);
    }

    private function setFields(Fields $fields): void
    {
        $fields->add("c_l.casino_id", "casino_id");
        $fields->add("la.id", "id");
        $fields->add("la.name", "name");
        $fields->add("la.code", "code");
    }
}