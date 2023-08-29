<?php

namespace Hlis\SlotsMateModels\DAOs\Author;

use Hlis\SlotsMateModels\Builders\Author\SocialNetworks as SocialNetworksBuilder;
use Hlis\SlotsMateModels\Builders\Author\Info\Basic as AuthorBuilder;

use Hlis\SlotsMateModels\Queries\Author\SocialNetworksQuery;
use Hlis\SlotsMateModels\Queries\Author\AuthorListItemsQuery;

use Hlis\GlobalModels\DAOs\AbstractEntityList;

class AuthorListItems extends AbstractEntityList
{

    protected function appendBranches(array $ids): void
    {
        $this->appendSocialNetworks($ids);
    }

    protected function createTrunks(): void
    {
        $builder = new AuthorBuilder();
        $querier = new AuthorListItemsQuery($this->filter, $this->orderByAlias, $this->limit, $this->offset);
        $resultSet = SQL($querier->getQuery(), $querier->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entities[$row["id"]] = $builder->build($row);
        }
    }

    protected function appendSocialNetworks($ids): void
    {
        $this->filter->setAuthorIDs(implode(",",$ids));
        $builder = new SocialNetworksBuilder();
        $querier = new SocialNetworksQuery($this->filter);
        $resultSet = SQL($querier->getQuery(), $querier->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entities[$row["author_id"]]->social_networks[] = $builder->build($row);
        }
    }

}