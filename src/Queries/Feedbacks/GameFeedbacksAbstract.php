<?php

namespace Hlis\SlotsMateModels\Queries\Feedbacks;

use Hlis\GlobalModels\Filters\Filter;
use Hlis\GlobalModels\Queries\Query;
use Hlis\GlobalModels\SchemaDetector;
use Lucinda\Query\Clause\Condition;

class GameFeedbacksAbstract extends Query
{
    protected Filter $filter;
    protected string $schema;

    public function __construct()
    {
        $this->schema = SchemaDetector::getInstance()->getSiteSchema();
    }

    protected function setJoins()
    {
        if ($this->filter->hasComments()) {
            $join = $this->query->joinInner($this->schema . ".games__feedbacks_translations", "gft")->on();
            $this->query->joinInner($this->schema . ".countries", "c")->on(['gf.country_id' => 'c.id']);

        } else {
            $join = $this->query->joinLeft($this->schema . ".games__feedbacks_translations", "gft")->on();
            $this->query->joinLeft($this->schema . ".countries", "c")->on(['gf.country_id' => 'c.id']);

        }

        $join->set("gft.is_original_language", 1);
        $join->set("gft.feedback_id", "gf.id");

        $this->query->joinLeft($this->schema . ".games__feedbacks_translations", "gfto")->on(["gfto.feedback_id" => "gf.id", "gfto.is_original_language" => 1]);
        $this->query->joinLeft($this->schema . '.languages', 'l')->on(['gfto.language_id' => 'l.id']);

    }

    protected function setWhere(Condition $where)
    {
        if ($this->filter->getStatusesIds()) {
            $where->setIn("gf.status_id", $this->filter->getStatusesIds());
        } else {
            $where->set("gf.status_id", 2);
        }

        if ($this->filter->getId()) {
            $where->setIn("gf.id", $this->filter->getId());
        }

        if ($this->filter->getEntityIds()) {
            $where->setIn("gf.game_id", $this->filter->getEntityIds());
        }

        if ($this->filter->getIp()) {
            $where->setIn("gf.ip", ':ip');
            $this->parameters[':ip'] = $this->filter->getIp();
        }
    }

}