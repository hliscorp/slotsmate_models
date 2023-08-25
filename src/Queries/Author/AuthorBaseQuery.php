<?php

namespace Hlis\SlotsMateModels\Queries\Author;

use Hlis\SlotsMateModels\Filters\AuthorFilter;
use Hlis\SlotsMateModels\Queries\AbstractGeneralQuery;
use Hlis\SlotsMateModels\Queries\Author\ConditionsSetter\AuthorConditions;
use Hlis\SlotsMateModels\Queries\Author\FieldsSetter\AuthorFields;


class AuthorBaseQuery extends AbstractGeneralQuery
{

    protected AuthorFilter $filter;

    public function __construct(AuthorFilter $filter)
    {
        parent::__construct($filter);
    }

    protected function setQuery(): Select
    {
        return new Select($this->adminSchema.".writers", "t1");
    }

    protected function getConditions()
    {
        return new AuthorConditions($this->filter);
    }

    protected function getFields()
    {
        return new AuthorFields($this->filter);
    }

}