<?php

namespace Hlis\SlotsMateModels\Queries\Feedbacks;

use Hlis\SlotsMateModels\Filters\Feedback;
use Hlis\GlobalModels\Queries\Query;
use Lucinda\Query\Operator\OrderBy as OrderByOperator;
use Lucinda\Query\Vendor\MySQL\Select;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Clause\Fields;

class GameFeedbacksList extends GameFeedbacksAbstract
{
    public function __construct(Feedback $filter, string $orderByAlias, int $limit, int $offset)
    {
        parent::__construct();
        $this->filter = $filter;
        $this->query = new Select($this->schema.".games__feedbacks", "gf");

        $this->setFields($this->query->fields());
        $this->setJoins();
        $this->setWhere($this->query->where());
        $this->setOrderBy($orderByAlias);
        $this->setLimit($limit, $offset);
    }

    protected function setFields(Fields $fields)
    {
        $fields->add("gf.id");
        $fields->add("gf.game_id", 'entity_id');
        $fields->add("gf.ip");
        $fields->add("gf.name", "user_name");
        $fields->add("gf.email", "user_email");
        $fields->add("gf.score");
        $fields->add("gf.date_added");
        $fields->add("(SELECT COUNT(id) FROM {$this->schema}.games__feedbacks_helpful WHERE feedback_id = gf.id AND status_id = 1)", "helpful");

        $fields->add("gft.title");
        $fields->add("gft.body");
        $fields->add("gft.language_id");
        $fields->add("gft.is_original_language");
        $fields->add("l.name", "original_language_name");
    }
    
    protected function setOrderBy(string $orderByAlias)
    {
        $orderBy = $this->query->orderBy();
        switch ($orderByAlias) {
            case 'helpful':
                $orderBy->add("helpful", OrderByOperator::DESC)->add("gf.id", OrderByOperator::DESC);
                break;
            case 'newest':
                $orderBy->add("gf.date_added", OrderByOperator::DESC)->add("gf.id", OrderByOperator::DESC);;
                break;
            default:
                $orderBy->add("gf.id", OrderByOperator::DESC);
                break;
        }
    }

    protected function setLimit(int $limit, int $offset)
    {
        if ($limit) {
            $this->query->limit($limit, $offset);
        }
    }

}