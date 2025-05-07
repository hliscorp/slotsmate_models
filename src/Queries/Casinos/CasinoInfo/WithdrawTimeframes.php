<?php

namespace Hlis\SlotsMateModels\Queries\Casinos\CasinoInfo;

use Hlis\GlobalModels\Queries\Query;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Clause\Fields;
use Lucinda\Query\Select;

class WithdrawTimeframes extends Query
{
    protected array $casinoIDs;
    protected array $allowedBankingMethodsTypes;

    public function __construct (array $casinoIDs, array $allowedBankingMethodsTypes = [])
    {
        $this->casinoIDs = $casinoIDs;
        $this->allowedBankingMethodsTypes = $allowedBankingMethodsTypes;
        $this->query = new Select("casinos__withdraw_timeframes", "t1");
        $this->setFields($this->query->fields());
        $this->setJoins();
        $this->setWhere($this->query->where());
    }

    protected function setFields(Fields $fields): void
    {
        $fields->add("t1.casino_id");
        $fields->add("t1.start");
        $fields->add("t1.end");
        $fields->add("t1.unit");
        $fields->add("t1.banking_method_type_id");
        $fields->add("t2.name", "banking_method_type_name");
    }

    protected function setJoins(): void
    {
        $this->query->joinInner("banking_method_types", "t2")->on(["t1.banking_method_type_id"=>"t2.id"]);
    }

    protected function setWhere(Condition $condition): void
    {
        $condition->setIn("t1.casino_id", $this->casinoIDs);
        if (!empty($this->allowedBankingMethodsTypes)) {
            $condition->setIn("t1.banking_method_type_id", $this->allowedBankingMethodsTypes);
        }
    }
}