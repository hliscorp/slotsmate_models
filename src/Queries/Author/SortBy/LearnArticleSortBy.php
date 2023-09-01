<?php

namespace Hlis\SlotsMateModels\Queries\Author;

use Hlis\SlotsMateModels\Enums\LearnArticleCriteria;
use Hlis\GlobalModels\Queries\AbstractOrderBy;
use Lucinda\Query\Operator\OrderBy;

class LearnArticleSortBy extends AbstractOrderBy
{
    protected function setByAlias(string $orderByAlias): void
    {
        switch ($orderByAlias) {
            case LearnArticleCriteria::DATE_CREATED:
                $this->orderBy->add("l.date_added", OrderBy::DESC);
                break;
            default:
                throw new \InvalidArgumentException("Invalid sort criteria: " . $orderByAlias);
        }
    }
}