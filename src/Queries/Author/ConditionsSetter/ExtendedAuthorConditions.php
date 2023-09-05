<?php

namespace Hlis\SlotsMateModels\Queries\Author\ConditionsSetter;

use Hlis\SlotsMateModels\Queries\Author\ConditionsSetter\AuthorConditions;
use Lucinda\Query\Clause\Condition;

class ExtendedAuthorConditions extends AuthorConditions
{

    public function appendConditions(Condition $condition): void
    {
        parent::appendConditions($condition);
    }

    protected function setLocaleCondition(Condition $condition): void
    {
        parent::setLocaleCondition($condition);
        $locale_id = $this->filter->getLocaleID() ?? "0";

        // Expertise
        $condition->set("t5.locale_id", $locale_id);
        // Full Bio
        $condition->set("t7.locale_id", $locale_id);
    }

}