<?php

namespace Hlis\SlotsMateModels\Queries\Author;

use Hlis\SlotsMateModels\Filters\AuthorFilter;
use Hlis\SlotsMateModels\Queries\Author\FieldsSetter\AuthorFields;
use Hlis\SlotsMateModels\Queries\Author\AuthorBaseQuery;
use Lucinda\Query\Clause\Fields;
use Lucinda\Query\Vendor\MySQL\Select;
use Lucinda\Query\Operator\OrderBy as OrderByOperator;


class AuthorListItemsQuery extends AuthorBaseQuery
{
    public function __construct(AuthorFilter $filter, string $orderByAlias, int $limit, int $offset)
    {
        parent::__construct($filter);
        $this->setLimit($limit, $offset);
    }

    protected function setOrderBy(string $orderByAlias): void
    {
        new AuthorOrderBy($this->query->orderBy(), $this->filter, $orderByAlias);
    }

    protected function setLimit(int $limit = null, int $offset = 0): void
    {
        if (!empty($limit)) {
            $this->query->limit($limit, $offset);
        }
    }
}