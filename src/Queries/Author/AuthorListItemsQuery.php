<?php

namespace Hlis\SlotsMateModels\Queries\Author;

use Hlis\SlotsMateModels\Filters\AuthorFilter;
use Hlis\SlotsMateModels\Queries\Author\FieldsSetter\AuthorFields;
use Hlis\SlotsMateModels\Queries\Author\SortBy\AuthorSortBy;
use Hlis\SlotsMateModels\Queries\Author\AuthorBaseQuery;
use Lucinda\Query\Clause\Fields;
use Lucinda\Query\Vendor\MySQL\Select;


class AuthorListItemsQuery extends AuthorBaseQuery
{
    public function __construct(AuthorFilter $filter, string $orderByAlias, int $limit, int $offset)
    {
        parent::__construct($filter);
        $this->setOrderBy($orderByAlias);
        $this->setGroupBy(["t1.id"]);
        $this->setLimit($limit, $offset);
    }

    protected function setOrderBy(string $orderByAlias): void
    {
        new AuthorSortBy($this->query->orderBy(), $this->filter, $orderByAlias);
    }

    protected function setLimit(int $limit = null, int $offset = 0): void
    {
        if (!empty($limit)) {
            $this->query->limit($limit, $offset);
        }
    }

    protected function setGroupBy($group): void
    {
        if (!empty($group)) {
            $this->query->groupBy($group);
        }
    }

}