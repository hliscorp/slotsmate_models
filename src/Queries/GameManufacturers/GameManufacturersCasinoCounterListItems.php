<?php
namespace Hlis\SlotsMateModels\Queries\GameManufacturers;
use Hlis\SlotsMateModels\Queries\GameManufacturers\FieldsSetter\GameManufacturerCounterListFields;
use Hlis\SlotsMateModels\Queries\GameManufacturers\ConditionsSetter\ListConditionsSetter;
use Hlis\SlotsMateModels\Queries\GameManufacturers\GameManufacturerListOrderBy;
use Hlis\GlobalModels\Queries\GameManufacturers\GameManufacturerListItems as DefaultGameManufacturerListItems;
use Hlis\SlotsMateModels\Queries\GameManufacturers\JoinsSetter\CounterListJoinsSetter;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Clause\Fields;
class GameManufacturersCounterListItems extends DefaultGameManufacturerListItems
{
    protected function setFields(Fields $fields): void
    {
        $object = new GameManufacturerCounterListFields($this->filter);
        $object->appendFields($fields);
    }

    protected function setJoins(): void
    {
        $setter = new CounterListJoinsSetter($this->filter, $this->query);
        $this->groupBy = $setter->isGroupBy();
    }

    protected function setWhere(Condition $condition): void
    {
        $setter = new ListConditionsSetter($this->filter);
        $setter->appendConditions($condition);
        $this->parameters = $setter->getParameters();

    }

    protected function setOrderBy(string $orderByAlias): void
    {
        new GameManufacturerListOrderBy($this->query->orderBy(), $this->filter, $orderByAlias);
    }

    protected function setGroupBy(): void
    {

    }
}