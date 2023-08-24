<?php

namespace Hlis\SlotsMateModels\Queries\Author\ConditionsSetter;

use \Hlis\GlobalModels\Queries\AbstractConditions;

class SocialNetworksConditions extends AbstractConditions
{

    public function appendConditions(Condition $condition): void
    {
        $this->setIDCondition($condition);
    }

    protected function setIDCondition(Condition $condition): void
    {
        if ($author_id = $this->filter->getAuthorID()) {
            $condition->set("t2.author_id", $author_id);
        }
    }

}