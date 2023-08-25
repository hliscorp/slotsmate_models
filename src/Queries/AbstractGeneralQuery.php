<?php

namespace Hlis\SlotsMateModels\Queries;

use Hlis\GlobalModels\Queries\AbstractFields;
use Hlis\GlobalModels\Queries\AbstractConditions;
use Hlis\GlobalModels\Queries\Query;
use Hlis\GlobalModels\SchemaDetector;
use Hlis\GlobalModels\Filters\Filter;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Clause\Fields;
use Lucinda\Query\Vendor\MySQL\Select;

class AbstractGeneralQuery extends Query
{

    protected string $siteSchema = "";
    protected string $adminSchema = "";
    protected Filter $filter;

    public function __construct(Filter $filter)
    {
        $this->siteSchema = SchemaDetector::getInstance()->getSiteSchema();
        $this->adminSchema = SchemaDetector::getInstance()->getAdminSchema();
        var_dump($this->adminSchema);die;
        $this->query = $this->setQuery();
        $this->setFields($this->query->fields());
        $this->setJoins();
        $this->setWhere($this->query->where());
        $this->setOrderBy();
    }

    protected abstract function setQuery(): Select;
    protected abstract function getConditions(): AbstractConditions;
    protected abstract function getFields(): AbstractFields;

    protected abstract protected function setJoins(): void;
    protected abstract protected function setOrderBy(): void;

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