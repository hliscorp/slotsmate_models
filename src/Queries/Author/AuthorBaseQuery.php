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
        $this->setOrderBy();   
    }

    protected function setJoins(): void 
    {
        return new AuthorTaglineJoin($this->filter, $this->query);
    }

    protected function setOrderBy(): void {}

    private function setFields(Fields $fields): void
    {
        $setter = new AuthorFields($this->filter);
        $setter->appendFields($fields);
    }

    private function setWhere(Condition $condition): void
    {
        $setter = new AuthorConditions($this->filter);
        $setter->appendConditions($condition);
        $this->parameters = $setter->getParameters();
    }

}