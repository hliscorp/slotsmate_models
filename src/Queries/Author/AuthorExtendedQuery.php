<?php

namespace Hlis\SlotsMateModels\Queries\Author;

use Hlis\SlotsMateModels\Queries\Author\ConditionsSetter\ExtendedAuthorConditions;
use Hlis\SlotsMateModels\Queries\Author\FieldsSetter\ExtendedAuthorFields;
use Hlis\SlotsMateModels\Queries\Author\JoinsSetter\AuthorExpertiseJoin;
use Hlis\SlotsMateModels\Queries\Author\JoinsSetter\AuthorFullBioJoin;
use Hlis\SlotsMateModels\Filters\AuthorFilter;
use Hlis\SlotsMateModels\Queries\Author\AuthorBaseQuery;
use Lucinda\Query\Clause\Fields;


class AuthorExtendedQuery extends AuthorBaseQuery
{
    public function __construct(AuthorFilter $filter)
    {
        parent::__construct($filter);
    }

    protected function setJoins(): void 
    {
        parent::setJoins();
        $this->setExpertiseJoin();
        $this->setFullBioJoin();
    }

    protected function getFields(): ExtendedAuthorFields
    {
        return new ExtendedAuthorFields($this->filter);
    }

    private function setExpertiseJoin(): AuthorExpertiseJoin
    {
        return new AuthorExpertiseJoin($this->filter, $this->query);
    }

    private function setFullBioJoin(): AuthorFullBioJoin
    {
        return new AuthorFullBioJoin($this->filter, $this->query);
    }

}