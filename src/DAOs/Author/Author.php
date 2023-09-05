<?php

namespace Hlis\SlotsMateModels\DAOs\Author;

use Hlis\SlotsMateModels\Builders\Author\Info\Basic as BasicAuthorBuilder;
use Hlis\SlotsMateModels\Entities\Author\Author as AuthorEntity;
use Hlis\SlotsMateModels\Queries\Author\AuthorBaseQuery;
use Hlis\SlotsMateModels\Filters\AuthorFilter;
use Hlis\GlobalModels\DAOs\AbstractEntityInfo;
use Hlis\SlotsMateModels\Builders\Author\SocialNetworks as SocialNetworksBuilder;
use Hlis\SlotsMateModels\Queries\Author\SocialNetworksQuery;

class Author extends AbstractEntityInfo
{

    public function __construct(AuthorFilter $filter)
    {
        $this->filter = $filter;
        $this->setInfo();
    }

    protected function createTrunk(): ?\Entity
    {
        $builder = $this->getBuilder();
        $querier = $this->getQuerier();
        $row = SQL($querier->getQuery(), $querier->getParameters())->toRow();

        if (empty($row)) {
            return null;
        }

        return $builder->build($row);
    }

    protected function appendBranches(): void
    {
        $this->appendSocialNetworks();
    }

    protected function getBuilder(): BasicAuthorBuilder
    {
        return new BasicAuthorBuilder();
    }

    protected function getQuerier(): AuthorBaseQuery
    {
        return new AuthorBaseQuery($this->filter);
    }

    private function appendSocialNetworks(): void
    {
        $builder = new SocialNetworksBuilder();
        $querier = new SocialNetworksQuery($this->filter);

        $resultSet = SQL($querier->getQuery(), $querier->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entity->social_networks[] = $builder->build($row);
        }
    }

}