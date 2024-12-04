<?php
namespace Hlis\SlotsMateModels\Queries\Casinos\CasinoList\Bonuses;

use Hlis\GlobalModels\Queries\Query;
use Lucinda\Query\Vendor\MySQL\Select;

class Targets extends Query
{
    protected array $bonusIDs;
    public function __construct(array $bonusIDs)
    {
        $this->bonusIDs = $bonusIDs;
        $this->query = new Select("casinos__bonuses_targets", "t1");
        $this->setFields();
        $this->setJoins();
        $this->setWhere();
    }

    protected function setFields(): void
    {
        $fields = $this->query->fields();
        $fields->add("t1.casino_bonus_id", "bonus_id");
        $fields->add("t2.id", "country_id");
        $fields->add("t2.name", "country_name");
        $fields->add("t2.code", "country_code");
    }

    protected function setJoins(): void
    {
        $this->query->joinInner("countries", "t2")->on(["t1.country_id"=>"t2.id"]);
    }

    protected function setWhere(): void
    {
        $this->query->where()->setIn("t1.casino_bonus_id", $this->bonusIDs);
    }
}
