<?php

namespace Hlis\SlotsMateModels\DAOs\LearnArticles;

use Hlis\SlotsMateModels\Filters\LearnArticleFilter;
use Hlis\GlobalModels\DAOs\AbstractEntityTotal;
use Hlis\GlobalModels\Queries\Query;
use Hlis\SlotsMateModels\Queries\LearnArticles\LearnArticlesTotalQuery;

class LearnArticlesTotal extends AbstractEntityTotal
{
    public function __construct(LearnArticleFilter $filter)
    {
        parent::__construct($filter);
    }

    protected function getQuery(): Query
    {
        return new LearnArticlesTotalQuery($this->filter);
    }
}
