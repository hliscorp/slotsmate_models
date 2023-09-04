<?php

namespace Hlis\SlotsMateModels\Queries\LearnArticles;

use Hlis\SlotsMateModels\Filters\LearnArticleFilter;
use Hlis\SlotsMateModels\Queries\LearnArticles\ConditionsSetter\LearnArticleConditions;
use Hlis\SlotsMateModels\Queries\LearnArticles\FieldsSetter\LearnArticleFields;
use Hlis\SlotsMateModels\Queries\LearnArticles\JoinsSetter\LearnArticleJoin;
use Hlis\SlotsMateModels\Queries\LearnArticles\SortBy\LearnArticleSortBy;
use Hlis\GlobalModels\Queries\Query;
use Hlis\GlobalModels\SchemaDetector;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Clause\Fields;
use Lucinda\Query\Vendor\MySQL\Select;


class LearnArticlesQuery extends AbstractLearnArticlesQuery
{

    protected LearnArticleFilter $filter;

    public function __construct(LearnArticleFilter $filter, string $orderByAlias, int $limit, int $offset)
    {
        parent::__construct($filter);
        $this->filter = $filter;
        $this->query = new Select($this->siteSchema.".guidelines", "t1");
        $this->setFields($this->query->fields());
        $this->setJoins();
        $this->setWhere($this->query->where());
        $this->setOrderBy($orderByAlias);   
        $this->setLimit($limit, $offset);
    }

    protected function setOrderBy(string $orderByAlias): void
    {
        new LearnArticleSortBy($this->query->orderBy(), $this->filter, $orderByAlias);
    }

    private function setFields(Fields $fields): void
    {
        $setter = new LearnArticleFields($this->filter);
        $setter->appendFields($fields);
    }

    protected function setLimit(int $limit = null, int $offset = 0): void
    {
        if (!empty($limit)) {
            $this->query->limit($limit, $offset);
        }
    }

}