<?php

namespace Hlis\SlotsMateModels\Queries\LearnArticles;

use Hlis\SlotsMateModels\Filters\LearnArticleFilter;
use Lucinda\Query\Vendor\MySQL\Select;
use Lucinda\Query\Clause\Fields;

class LearnArticlesTotalQuery extends AbstractLearnArticlesQuery
{
    public function __construct(LearnArticleFilter $filter)
    {
        parent::__construct($filter);
        $this->query = new Select($this->siteSchema.".guidelines", "t1");
        $this->setWhere($this->query->where());
        $this->setGroupBy($this->query->fields());
    }

    protected function setGroupBy(Fields $fields): void
    {
        if ($this->groupBy) {
            $fields->add("COUNT(DISTINCT t1.id)", "total");
        } else {
            $fields->add("COUNT(t1.id)", "total");
        }
    }
}