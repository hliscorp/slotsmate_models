<?php

namespace Hlis\SlotsMateModels\Queries\Author\SortBy;

use Hlis\SlotsMateModels\Enums\AuthorSortCriteria;
use Hlis\GlobalModels\Queries\AbstractOrderBy;
use Lucinda\Query\Operator\OrderBy;

class AuthorSortBy extends AbstractOrderBy
{
    protected function setByAlias(string $orderByAlias): void
    {
        switch ($orderByAlias) {
            case AuthorSortCriteria::NAME:
                $this->orderBy->add("t1.first_name", OrderBy::ASC);
                break;
            case AuthorSortCriteria::DATE_CREATED:
                $this->orderBy->add("t1.date_added", OrderBy::DESC);
                break;
            default:
                throw new \InvalidArgumentException("Invalid sort criteria: " . $orderByAlias);
        }
    }
}