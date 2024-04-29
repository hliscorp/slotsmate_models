<?php

namespace Hlis\SlotsMateModels\Queries\Feedbacks;

use Hlis\SlotsMateModels\Filters\Feedback;
use Lucinda\Query\Vendor\MySQL\Select;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Clause\Fields;

class GameFeedbacksTotal extends GameFeedbacksAbstract
{
    public function __construct(Feedback $filter)
    {
        parent::__construct();

        $this->filter = $filter;

        $this->query = new Select($this->schema.".games__feedbacks", "gf");

        $this->setFields($this->query->fields());
        $this->setJoins();
        $this->setWhere($this->query->where());
    }

    protected function setFields(Fields $fields)
    {
        $fields->add("COUNT(gf.id)", "total");
    }

    protected function setJoins()
    {
        if ($this->filter->hasComments()) {
            $join = $this->query->joinInner($this->schema . ".games__feedbacks_translations", "gft")->on();
            $join->set("gft.is_original_language", 1);
            $join->set("gft.feedback_id", "gf.id");
        }
    }



}