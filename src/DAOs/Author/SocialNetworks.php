<?php

namespace Hlis\SlotsMateModels\DAOs\Author;

use \Hlis\GlobalModels\DAOs\AbstractEntityList;
use Hlis\SlotsMateModels\Builders\Author\SocialNetwork as SocialNetworksBuilder;
use Hlis\SlotsMateModels\Filters\Author\SocialNetworksFilter;
use Hlis\SlotsMateModels\Queries\Author\SocialNetworksQuery;

class SocialNetworks extends AbstractEntityList
{

    protected function createTrunks(): void
    {
        $builder = new SocialNetworksBuilder();
        $filter = new SocialNetworksFilter();
        $filter->setAuthorID($this->filter->getAuthorID());

        $querier = new SocialNetworksQuery();

        $resultSet = SQL($querier->getQuery(), $querier->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entities[$row["id"]] = $builder->build($row);
        }
    }

}