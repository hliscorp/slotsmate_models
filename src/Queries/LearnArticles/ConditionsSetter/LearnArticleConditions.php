<?php

namespace Hlis\SlotsMateModels\Queries\LearnArticles\ConditionsSetter;

use Hlis\GlobalModels\Queries\AbstractConditions;
use Lucinda\Query\Clause\Condition;

class LearnArticleConditions extends AbstractConditions
{

    public function appendConditions(Condition $condition): void
    {
        $this->setAuthorCondition($condition);
        $this->setDraftCondition($condition);
        $this->setCategoryCondition($condition);
    }

    protected function setAuthorCondition(Condition $condition): void
    {
        if ($ids = $this->filter->getAuthorIDs()) {
            $condition->setIn("t1.writer_id", $ids);
        }
    }

    protected function setCategoryCondition(Condition $condition): void
    {
        if ($ids = $this->filter->getCategoryIds()) {
            $condition->setIn("t3.category_id", $ids);
        }
    }

    protected function setDraftCondition(Condition $condition): void
    {
        $condition->set("t1.is_draft", 0);
        $condition->set("t1.is_deleted", 0);
    }

}