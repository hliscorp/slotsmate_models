<?php
namespace Hlis\SlotsMateModels\Queries\GameManufacturers;
use Hlis\SlotsMateModels\Queries\GameManufacturers\FieldsSetter\GameManufacturerListFields;
use Hlis\SlotsMateModels\Queries\GameManufacturers\ConditionsSetter\ListConditionSetter;
use Hlis\GlobalModels\Queries\GameManufacturers\GameManufacturerListItems as DefaultGameManufacturerListItems;
use Hlis\SlotsMateModels\Queries\GameManufacturers\JoinsSetter\ListJoinsSetter;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Clause\Fields;
class GameManufacturersListItems extends DefaultGameManufacturerListItems
{
    protected function setFields(Fields $fields): void
    {
        $object = new GameManufacturerListFields($this->filter);
        $object->appendFields($fields);
    }

    protected function setJoins(): void
    {
        $setter = new ListJoinsSetter($this->filter, $this->query);
        $this->groupBy = $setter->isGroupBy();
    }

    protected function setWhere(Condition $condition): void
    {
        $setter = new ListConditionSetter($this->filter);
        $setter->appendConditions($condition);
        $this->parameters = $setter->getParameters();

    }

    protected function setGroupBy(): void
    {
        $this->query->groupBy("t1.id");
    }

    protected function setOrderBy(string $orderByAlias): void
    {
        new GameManufacturerListOrderBy($this->query->orderBy(), $this->filter, $orderByAlias);
    }
}