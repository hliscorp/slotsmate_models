<?php

namespace Hlis\SlotsMateModels\Queries\Author\ConditionsSetter;

use Hlis\GlobalModels\Queries\AbstractConditions;
use Lucinda\Query\Clause\Condition;

class SocialNetworksConditions extends AbstractConditions
{

    public function appendConditions(Condition $condition): void
    {
        $this->setIDCondition($condition);
    }

    protected function setIDCondition(Condition $condition): void
    {
        if ($author_ids = $this->filter->getAuthorIDs()) {
            $condition->setIn("t2.author_id", $author_ids);
        }
    }

}