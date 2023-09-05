<?php

namespace Hlis\SlotsMateModels\Queries\Author;

use Hlis\SlotsMateModels\Queries\Author\ConditionsSetter\AuthorConditions;
use Hlis\SlotsMateModels\Queries\Author\FieldsSetter\AuthorFields;
use Hlis\SlotsMateModels\Queries\Author\JoinsSetter\AuthorTaglineJoin;
use Hlis\SlotsMateModels\Filters\AuthorFilter;

use Hlis\GlobalModels\Queries\Query;
use Hlis\GlobalModels\SchemaDetector;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Clause\Fields;
use Lucinda\Query\Vendor\MySQL\Select;


class AuthorBaseQuery extends Query
{

    protected AuthorFilter $filter;
    protected string $siteSchema = "";
    protected string $adminSchema = "";

    public function __construct(AuthorFilter $filter)
    {
        $this->filter = $filter;
        $this->siteSchema = SchemaDetector::getInstance()->getSiteSchema();
        $this->adminSchema = SchemaDetector::getInstance()->getAdminSchema();
        $this->query = new Select($this->adminSchema.".writers", "t1");
        $this->setFields($this->query->fields());
        $this->setJoins();
        $this->setWhere($this->query->where());
    }

    protected function setJoins(): void 
    {
       $this->setTaglineJoin();
    }

    protected function setTaglineJoin(): AuthorTaglineJoin
    {
        return new AuthorTaglineJoin($this->filter, $this->query);
    }

    protected function getFields(): AuthorFields
    {
        return new AuthorFields($this->filter);
    }

    protected function getConditions(): AuthorConditions
    {
        return new AuthorConditions($this->filter);
    }

    protected function setFields(Fields $fields): void
    {
        $setter = $this->getFields();
        $setter->appendFields($fields);
    }

    protected function setWhere(Condition $condition): void
    {
        $setter = $this->getConditions();
        $setter->appendConditions($condition);
        $this->parameters = $setter->getParameters();
    }

}