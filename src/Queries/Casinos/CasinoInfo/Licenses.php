<?php

namespace Hlis\SlotsMateModels\Queries\Casinos\CasinoInfo;

use Hlis\GlobalModels\Filters\Filter;
use Hlis\GlobalModels\Queries\Query;
use Lucinda\Query\Select;

class Licenses extends Query
{
    public function __construct(Filter $filter)
    {
        $this->query = new Select("licenses", "t1");
        $this->setFields($this->query->fields());
        $this->setJoins($filter);
    }
    protected function setFields(\Lucinda\Query\Clause\Fields $fields): void
    {
        $fields->add("t1.id", "license_id");
        $fields->add("t1.name", "license_name");
        $fields->add("IF(t5.name IS NOT NULL, t5.name, t6.name)", "location");
    }

    protected function setJoins(Filter $filter): void
    {
        $this->query->joinInner("casinos__licenses", "t2")->on([
            "t1.id" => "t2.license_id",
            "t2.casino_id" => key($filter->getId())
        ]);
        $this->query->joinInner("jurisdictions__licenses", "t3")->on([
            "t1.id" => "t3.license_id"
        ]);
        $this->query->joinInner("jurisdictions", "t4")->on([
            "t3.jurisdiction_id" => "t4.id"
        ]);
        $this->query->joinLeft("countries", "t5")->on([
            "t4.country_id" => "t5.id"
        ]);
        $this->query->joinLeft("regions", "t6")->on([
            "t4.region_id" => "t6.id"
        ]);
    }
}
