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
        $this->setLocaleCondition($condition);
        $this->setDisabledCondition($condition);
    }

    protected function setIDCondition(Condition $condition): void
    {
        if ($id = $this->filter->getAuthorIDs()) {
            $condition->setIn("t1.id", $ids);
        }
    }

    protected function setNameCondition(Condition $condition): void
    {
        if ($full_name = $this->filter->getName()) {
            $condition->set("LOWER(CONCAT(t1.first_name,' ', t1.last_name))", "'".$full_name."'");
        }
    }

    protected function setLocaleCondition(Condition $condition): void
    {
        if ($locale_id = $this->filter->getLocaleID()) {
            $condition->set("t4.locale_id", $locale_id);
        }
    }

    protected function setDisabledCondition(Condition $condition): void
    {
        if ($is_disabled = $this->filter->getDisabledStatus()) {
            $condition->set("t1.disabled", $is_disabled);
        }
    }

}