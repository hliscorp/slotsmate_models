<?php

namespace Hlis\SlotsMateModels\DAOs\LearnArticles;

use Hlis\SlotsMateModels\Builders\LearnArticles\LearnArticle as LearnArticlesBuilder;
use Hlis\SlotsMateModels\Queries\LearnArticles\LearnArticlesQuery;
use Hlis\SlotsMateModels\Filters\LearnArticleFilter;

use Hlis\GlobalModels\DAOs\AbstractEntityList;

class LearnArticlesList extends AbstractEntityList
{

    protected function createTrunks(): void
    {
        $builder = new LearnArticlesBuilder();
        $querier = new LearnArticlesQuery($this->filter, $this->orderByAlias, $this->limit, $this->offset);
        $resultSet = SQL($querier->getQuery(), $querier->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entities[$row["id"]] = $builder->build($row);
        }
    }

    protected function appendBranches(array $ids): void 
    {
        // nothing to append
    }

}