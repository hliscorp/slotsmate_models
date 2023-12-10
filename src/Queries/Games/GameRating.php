<?php

namespace Hlis\SlotsMateModels\Queries\Games;

use Hlis\GlobalModels\Queries\Query;
use Hlis\SlotsMateModels\Queries\Games\ConditionsSetter\GameRatingConditions;
use Hlis\SlotsMateModels\Queries\Games\FieldsSetter\GameRatingFields;
use Hlis\SlotsMateModels\Queries\Games\JoinsSetter\GameRatingJoins;
use Hlis\SlotsMateModels\Filters\GameManufacturer;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Clause\Fields;
use Lucinda\Query\Vendor\MySQL\Select;

class GameRating extends Query
{
    protected GameManufacturer $filter;
    public function __construct(GameManufacturer $filter)
    {
        $this->filter = $filter;
        $this->query = new Select("games", "t1");
        $this->setFields($this->query->fields());
        $this->setJoins();
        $this->setWhere($this->query->where());
        $this->setGroupBy();
    }

    private function setFields(Fields $fields): void
    {
        $setter = new GameRatingFields($this->filter);
        $setter->appendFields($fields);
    }

    private function setWhere(Condition $condition): void
    {
        $setter = new GameRatingConditions($this->filter);
        $setter->appendConditions($condition);
        $this->parameters = $setter->getParameters();
    }

    protected function setJoins(): void
    {
        new GameRatingJoins($this->filter, $this->query);
    }

    protected function setGroupBy(): void
    {
        $this->query->groupBy(["t1.id"]);
    }
}