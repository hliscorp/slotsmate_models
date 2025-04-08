<?php
namespace Hlis\SlotsMateModels\Queries\Casinos\CasinoList;

use Lucinda\Query\Clause\Fields;
use Lucinda\Query\Select;

class TargetedDepositMinimums extends \Hlis\GlobalModels\Queries\Query
{
    protected string $baseTable = "casinos__minimum_deposit";
    protected int $selectedCountry;
    public function __construct (array $casinoIDs, int $selectedCountry)
    {
        $this->selectedCountry = $selectedCountry;
        $this->query = new Select($this->baseTable, "t1");
        $this->setFields($this->query->fields());
        $this->setJoins();
        $this->setWhere($this->query->where(), $casinoIDs);
    }

    protected function setFields(Fields $fields): void
    {
        $fields->add("t1.casino_id");
        $fields->add("t1.value");
        $fields->add("t3.code", "country_code");
        $fields->add("t3.name", "country_name");
        $fields->add("t3.id", "country_id");
        $fields->add("t4.code", "currency_code");
        $fields->add("t4.symbol", "currency_symbol");
        $fields->add("t4.id", "currency_id");
    }

    protected function setJoins(): void
    {
        $this->query->joinInner($this->baseTable . "__countries", "t2")->on(["t1.id"=>"t2.record_id", "t2.country_id"=> $this->selectedCountry]);
        $this->query->joinInner("countries", "t3")->on(["t2.country_id"=>"t3.id"]);
        $this->query->joinLeft("currencies", "t4")->on(["t1.currency_id"=>"t4.id"]);
    }

    protected function setWhere(\Lucinda\Query\Clause\Condition $condition, array $casinoIDs): void
    {
        $condition->setIn("t1.casino_id", $casinoIDs);
    }

}