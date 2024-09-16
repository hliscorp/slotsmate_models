<?php

namespace Hlis\SlotsMateModels\Queries\LearnArticles\SortBy;

use Hlis\SlotsMateModels\Enums\LearnArticleCriteria;
use Hlis\GlobalModels\Queries\AbstractOrderBy;
use Lucinda\Query\Operator\OrderBy;

class LearnArticleSortBy extends AbstractOrderBy
{
    protected function setByAlias(string $orderByAlias): void
    {
        switch ($orderByAlias) {
            case LearnArticleCriteria::DATE_CREATED:
                $this->orderBy->add("t1.date_added", OrderBy::DESC);
                $this->orderBy->add("t1.id", OrderBy::DESC);
                break;
            case LearnArticleCriteria::PRIORITY:
                $this->orderBy->add("t1.priority");
                $this->orderBy->add("t1.date_added", OrderBy::DESC);
                $this->orderBy->add("t1.id", OrderBy::DESC);
                break;
            default:
                throw new \InvalidArgumentException("Invalid sort criteria: " . $orderByAlias);
        }
    }
}