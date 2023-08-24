<?php

namespace Hlis\SlotsMateModels\DAOs\Author;

use \Hlis\GlobalModels\DAOs\AbstractEntityList;
use Hlis\SlotsMateModels\Builders\Author\Taglines as TaglinesBuilder;
use Hlis\SlotsMateModels\Filters\Author\TaglinesFilter;
use Hlis\SlotsMateModels\Queries\Author\TaglinesQuery;

class Taglines extends AbstractEntityList
{

    protected function createTrunks(): void
    {
        $builder = new TaglinesBuilder();
        $filter = new TaglinesFilter();
        $filter->setAuthorID($this->filter->getAuthorID());

        $querier = new TaglinesQuery($filter, $this->orderByAlias, $this->limit, $this->offset);

        $resultSet = SQL($querier->getQuery(), $querier->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entities[$row["id"]] = $builder->build($row);
        }
    }

}