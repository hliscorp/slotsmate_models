<?php

namespace Hlis\SlotsMateModels\Queries\Author\ConditionsSetter;

use Hlis\GlobalModels\Queries\AbstractConditions;

class AuthorConditions extends AbstractConditions
{

    public function appendConditions(Condition $condition): void
    {
        $this->setIDCondition($condition);
        $this->setNameCondition($condition);
    }

    protected function setIDCondition(Condition $condition): void
    {
        if ($id = $this->filter->getAuthorID()) {
            $condition->set("t1.id", $id);
        }
    }

    protected function setNameCondition(Condition $condition): void
    {
        if ($full_name = $this->filter->getName()) {
            $condition->set("LOWER(CONCAT(t1.first_name,' ', t1.last_name))", $full_name);
        }
    }

}