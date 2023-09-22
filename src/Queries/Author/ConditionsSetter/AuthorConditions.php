<?php

namespace Hlis\SlotsMateModels\Queries\Author\ConditionsSetter;

use Hlis\GlobalModels\Queries\AbstractConditions;
use Lucinda\Query\Clause\Condition;

class AuthorConditions extends AbstractConditions
{

    public function appendConditions(Condition $condition): void
    {
        $this->setIDCondition($condition);
        $this->setNameCondition($condition);
        $this->setDisabledCondition($condition);
    }

    protected function setIDCondition(Condition $condition): void
    {
        if ($ids = $this->filter->getAuthorIDs()) {
            $condition->setIn("t1.id", $ids);
        }
    }

    protected function setNameCondition(Condition $condition): void
    {
        if ($full_name = $this->filter->getName()) {
            $condition->set("LOWER(CONCAT(t1.first_name,' ', t1.last_name))", "'".$full_name."'");
        }
    }

    protected function setDisabledCondition(Condition $condition): void
    {
        if($this->filter->getDisabledStatus() === null) return;

        if($this->filter->getDisabledStatus() === true) {
            $is_disabled = 1;
        } else {
            $is_disabled = 0;
        }
        
        $condition->set("t1.disabled", $is_disabled);
    }

}
