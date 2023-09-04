<?php

namespace Hlis\SlotsMateModels\Queries\LearnArticles;

use Hlis\SlotsMateModels\Filters\LearnArticleFilter;
use Hlis\SlotsMateModels\Queries\LearnArticles\ConditionsSetter\LearnArticleConditions;
use Hlis\SlotsMateModels\Queries\LearnArticles\JoinsSetter\LearnArticleJoin;
use Hlis\GlobalModels\Queries\Query;
use Hlis\GlobalModels\SchemaDetector;
use Lucinda\Query\Clause\Condition;

class AbstractLearnArticlesQuery extends Query
{
    protected LearnArticleFilter $filter;
    protected bool $groupBy = false;

    protected string $siteSchema = "";
    protected string $adminSchema = "";

    public function __construct(AuthorFilter $filter)
    {
        $this->filter = $filter;
        $this->siteSchema = SchemaDetector::getInstance()->getSiteSchema();
        $this->adminSchema = SchemaDetector::getInstance()->getAdminSchema();
    }

    protected function setWhere(Condition $condition): void
    {
        $setter = new LearnArticleConditions($this->filter);
        $setter->appendConditions($condition);
        $this->parameters = $setter->getParameters();
    }

    protected function setJoins(): void
    {
        new LearnArticleJoin($this->filter, $this->query);
    }
}