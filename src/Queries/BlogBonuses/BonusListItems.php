<?php

namespace Hlis\SlotsMateModels\Queries\BlogBonuses;

use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Clause\Fields;
use Hlis\GlobalModels\Queries\BlogBonuses\BonusListItems as GlobalBonusListItems;
use Hlis\GlobalModels\Queries\BlogBonuses\JoinsSetter\BonusListItemsJoins;
use Hlis\SlotsMateModels\Queries\BlogBonuses\JoinsSetter\BonusListJoins;
use Hlis\SlotsMateModels\Queries\BlogBonuses\FieldSetter\BonusListItemsFields;
use Hlis\SlotsMateModels\Queries\BlogBonuses\ConditionsSetter\BonusListConditions;

class BonusListItems extends GlobalBonusListItems
{
    protected function setFields(Fields $fields): void
    {
        $setter = new BonusListItemsFields($this->filter);
        $setter->appendFields($fields);
    }

    protected function setJoins(): void
    {
        $setter1 = new BonusListItemsJoins($this->filter, $this->query);
        $groupBy1 = $setter1->isGroupBy();

        $setter2 = new BonusListJoins($this->filter, $this->query);
        $groupBy2 = $setter2->isGroupBy();

        $this->groupBy = $groupBy1 || $groupBy2;
    }

    protected function setWhere(Condition $condition): void
    {
        $setter = new BonusListConditions($this->filter);
        $setter->appendConditions($condition);
        $this->parameters = $setter->getParameters();
    }

    protected function setOrderBy(string $orderByAlias): void
    {
        new BasicOrderBy($this->query->orderBy(), $this->filter, $orderByAlias);
    }
}