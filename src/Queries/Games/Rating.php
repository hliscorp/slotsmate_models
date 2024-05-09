<?php

namespace Hlis\SlotsMateModels\Queries\Games;

use Hlis\GlobalModels\Filters\Game as GamesFilter;
use Hlis\GlobalModels\Queries\Query;
use Hlis\GlobalModels\SchemaDetector;
use Lucinda\Query\Select;

class Rating extends Query
{
    protected GamesFilter $filter;
    protected string $schema;

    public function __construct(GamesFilter $filter)
    {
        $this->filter = $filter;
        $this->schema = SchemaDetector::getInstance()->getSiteSchema();
        $this->query = new Select($this->schema . ".games__feedbacks", "t1");
        $this->setFields();
        $this->setWhere();
    }

    protected function setFields()
    {
        $fields = $this->query->fields();
        $fields->add("t1.score");
        $fields->add("t1.game_id");
    }

    protected function setWhere(): void
    {
        $where = $this->query->where();
        $where->setIn("t1.game_id", $this->filter->getId());
        $where->set('t1.status_id', 2);    }
}