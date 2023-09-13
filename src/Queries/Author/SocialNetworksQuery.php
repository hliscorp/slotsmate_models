<?php

namespace Hlis\SlotsMateModels\Queries\Author;

use Hlis\SlotsMateModels\Filters\AuthorFilter;
use Hlis\SlotsMateModels\Queries\Author\ConditionsSetter\SocialNetworksConditions;
use Hlis\SlotsMateModels\Queries\Author\FieldsSetter\SocialNetworksFields;
use Hlis\SlotsMateModels\Queries\Author\JoinsSetter\SocialNetworksJoin;
use Hlis\GlobalModels\Queries\Query;
use Hlis\GlobalModels\SchemaDetector;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Clause\Fields;
use Lucinda\Query\Vendor\MySQL\Select;
use Lucinda\Query\Operator\OrderBy;


class SocialNetworksQuery extends Query
{

    protected AuthorFilter $filter;

    public function __construct(AuthorFilter $filter)
    {
        $this->filter = $filter;
        $this->query = new Select(SchemaDetector::getInstance()->getAdminSchema().".author__social_networks", "t2");
        $this->setFields($this->query->fields());
        $this->setJoins();
        $this->setWhere($this->query->where());
        $this->setOrderBy();   
    }

    protected function setOrderBy(): void 
    {
        $this->query->orderBy()->add("t3.prority", OrderBy::DESC);
    }

    private function setFields(Fields $fields): void
    {
        $setter = new SocialNetworksFields($this->filter);
        $setter->appendFields($fields);
    }

    private function setWhere(Condition $condition): void
    {
        $setter = new SocialNetworksConditions($this->filter);
        $setter->appendConditions($condition);
        $this->parameters = $setter->getParameters();
    }

    protected function setJoins(): void
    {
        new SocialNetworksJoin($this->filter, $this->query);
    }

}