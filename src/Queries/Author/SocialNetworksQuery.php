<?php

namespace Hlis\SlotsMateModels\Queries\Author;

use Hlis\SlotsMateModels\Filters\Author\AuthorFilter;
use Hlis\SlotsMateModels\Queries\Author\ConditionsSetter\SocialNetworksConditions;
use Hlis\SlotsMateModels\Queries\Author\FieldsSetter\SocialNetworksFields;
use Hlis\SlotsMateModels\Queries\Author\JoinsSetter\SocialNetworksJoin;
use Hlis\GlobalModels\Queries\Query;
use Hlis\GlobalModels\SchemaDetector;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Clause\Fields;
use Lucinda\Query\Vendor\MySQL\Select;


class SocialNetworksQuery extends Query
{

    protected AuthorFilter $filter;
    protected string $siteSchema = "";
    protected string $adminSchema = "";

    public function __construct(AuthorFilter $filter)
    {
        $this->filter = $filter;
        $this->siteSchema = SchemaDetector::getInstance()->getSiteSchema();
        $this->adminSchema = SchemaDetector::getInstance()->getAdminSchema();
        $this->query = new Select($this->adminSchema.".author__social_networks", "t2");
        $this->setFields($this->query->fields());
        $this->setJoins();
        $this->setWhere($this->query->where());
        $this->setOrderBy();   
    }

    protected function setOrderBy(): void {}

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