<?php

namespace Hlis\SlotsMateModels\Queries;

use Hlis\GlobalModels\Queries\AbstractFields;
use Hlis\GlobalModels\Queries\AbstractConditions;
use Hlis\GlobalModels\Queries\Query;

abstract class AbstractGeneralQuery extends Query
{

    protected int $offset;
    protected int $limit;
    protected string $orderByAlias;
    protected $parentSchema;

    public function __construct(Filter $filter, $parentSchema = null, string $orderByAlias = null, int $limit = null, int $offset = null)
    {
        $this->filter = $filter;
        $this->orderByAlias = $orderByAlias;
        $this->offset = $offset;
        $this->limit = $limit;
        $this->parentSchema = $parentSchema;
        $this->query = $this->setQuery();
        $this->setFields($this->query->fields());
        $this->setJoins();
        $this->setWhere($this->query->where());
        $this->setOrderBy();
        $this->setLimit();
    }

    abstract protected function setQuery(): Select;

    abstract protected function getConditions(): AbstractConditions;

    abstract protected function getFields(): AbstractFields;

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