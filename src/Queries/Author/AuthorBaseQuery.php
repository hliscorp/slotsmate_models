<?php

namespace Hlis\SlotsMateModels\Queries\Author;

use Hlis\SlotsMateModels\Filters\AuthorFilter;
use Hlis\SlotsMateModels\Queries\AbstractGeneralQuery;
use Hlis\SlotsMateModels\Queries\Author\ConditionsSetter\AuthorConditions;
use Hlis\SlotsMateModels\Queries\Author\FieldsSetter\AuthorFields;


class AuthorBaseQuery extends AbstractGeneralQuery
{

    protected function setQuery(): Select
    {
        return new Select("{$this->parentSchema}.writers", "t1");
    }

    protected function getConditions(): AuthorConditions
    {
        return new AuthorConditions($this->filter);
    }

    protected function getFields(): AuthorFields
    {
        return new AuthorFields($this->filter);
    }

}