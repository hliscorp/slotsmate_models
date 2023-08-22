<?php

namespace Hlis\SlotsMateModels\Queries\Author;

use Hlis\SlotsMateModels\Queries\Author\ConditionsSetter\TaglinesConditions;
use Hlis\SlotsMateModels\Queries\Author\FieldsSetter\TaglinesFields;
use Hlis\SlotsMateModels\Queries\AbstractGeneralQuery;

class TaglinesQuery extends AbstractGeneralQuery
{

    protected function setQuery(): Select
    {
        return new Select("tagline__writers", "t4");
    }

    protected function getConditions(): TaglinesConditions
    {
        return new TaglinesConditions($this->filter);
    }

    protected function getFields(): TaglinesFields
    {
        return new TaglinesFields($this->filter);
    }

}