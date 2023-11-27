<?php

namespace Hlis\SlotsMateModels\Queries\Casinos\CasinoList;

use Hlis\GlobalModels\Queries\Query;
use Lucinda\Query\Clause\Fields;
use Lucinda\Query\Select;

class RatingInfo extends Query
{
    public function __construct(array $casinoIDs)
    {
        $this->query = new Select("casinos");
        $this->setFields($this->query->fields());
        $this->query->where()->setIn("id", $casinoIDs);
    }

    private function setFields(Fields $fields): void
    {
        $fields->add("id", "casino_id");
        $fields->add("rating_total");
        $fields->add("rating_votes");
    }
}