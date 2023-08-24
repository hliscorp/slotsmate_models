<?php

namespace Hlis\SlotsMateModels\Queries;

use Hlis\SlotsMateModels\Filters\Author\AuthorFilter;

use Hlis\GlobalModels\Queries\AbstractFields;
use Hlis\GlobalModels\Queries\AbstractConditions;
use Hlis\GlobalModels\Queries\Query;
use Hlis\GlobalModels\SchemaDetector;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Clause\Fields;
use Lucinda\Query\Vendor\MySQL\Select;

abstract class AbstractGeneralQuery extends Query
{

    protected string $siteSchema = "";
    protected string $adminSchema = "";

    public function __construct(Filter $filter)
    {
        $this->filter = $filter;
        $this->siteSchema = SchemaDetector::getInstance()->getSiteSchema();
        $this->adminSchema = SchemaDetector::getInstance()->getAdminSchema();
        $this->query = $this->setQuery();
        $this->setFields($this->query->fields());
        $this->setJoins();
        $this->setWhere($this->query->where());
        $this->setOrderBy();
        $this->setLimit();
    }

    abstract protected function setQuery(): Select;

    protected function getConditions() {}
    protected function getFields() {}

    protected function setJoins() {}
    protected function setOrderBy() {}

    private function setLimit(): void
    {
        if ($this->limit) {
            $this->query->limit($this->limit, $this->offset);
        }
    }

    private function setFields(Fields $fields): void
    {
        $setter = $this->getFields();
        $setter->appendFields($fields);
    }

    private function setWhere(Condition $condition): void
    {
        $setter = $this->getConditions();
        $setter->appendConditions($condition);
        $this->parameters = $setter->getParameters();
    }

}