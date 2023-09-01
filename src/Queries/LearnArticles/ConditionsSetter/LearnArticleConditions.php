<?php

namespace Hlis\SlotsMateModels\Queries\LearnArticles\ConditionsSetter;

use Hlis\GlobalModels\Queries\AbstractConditions;
use Lucinda\Query\Clause\Condition;

class LearnArticleConditions extends AbstractConditions
{

    public function appendConditions(Condition $condition): void
    {
        $this->setAuthorCondition($condition);
    }

    protected function setAuthorCondition(Condition $condition): void
    {
        if ($ids = $this->filter->getAuthorIDs()) {
            $condition->setIn("l.writer_id", $ids);
        }
    }

}