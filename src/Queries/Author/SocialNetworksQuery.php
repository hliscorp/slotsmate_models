<?php

namespace Hlis\SlotsMateModels\Queries\Author;

use Hlis\SlotsMateModels\Filters\Author\AuthorFilter;
use Hlis\SlotsMateModels\Queries\Author\ConditionsSetter\SocialNetworksConditions;
use Hlis\SlotsMateModels\Queries\Author\FieldsSetter\SocialNetworksFields;
use Hlis\SlotsMateModels\Queries\Author\JoinsSetter\SocialNetworksJoin;
use Hlis\SlotsMateModels\Queries\AbstractGeneralQuery;

class SocialNetworksQuery extends AbstractGeneralQuery
{

    protected function setQuery(): Select
    {
        return new Select("author__social_networks", "t2");
    }

    protected function getConditions(): SocialNetworksConditions
    {
        return new SocialNetworksConditions($this->filter);
    }

    protected function getFields(): SocialNetworksFields
    {
        return new SocialNetworksFields($this->filter);
    }

    protected function setJoins(): void
    {
        new SocialNetworksJoin($this->filter, $this->query);
    }

}