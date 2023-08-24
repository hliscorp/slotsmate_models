<?php

namespace Hlis\SlotsMateModels\Queries\Author\ConditionsSetter;

use Hlis\GlobalModels\Queries\AbstractConditions;
use Lucinda\Query\Clause\Condition;

class TaglinesConditions extends AbstractConditions
{

    public function appendConditions(Condition $condition): void
    {
        $this->setIDCondition($condition);
        $this->setLocaleCondition($condition);
    }

    protected function setIDCondition(Condition $condition): void
    {
        if ($author_id = $this->filter->getAuthorID()) {
            $condition->set("t4.author_id", $author_id);
        }
    }

    protected function setLocaleCondition(Condition $condition): void
    {
        if ($locale_id = $this->filter->getLocaleID()) {
            $condition->set("t4.locale_id", $locale_id);
        }
    }

}