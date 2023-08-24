<?php

namespace Hlis\SlotsMateModels\DAOs\Author;

use Hlis\SlotsMateModels\Builders\Author\Info\Basic as BasicAuthorBuilder;
use Hlis\SlotsMateModels\Entities\Author\Author as AuthorEntity;
use Hlis\SlotsMateModels\Queries\Author\AuthorBaseQuery;
use Hlis\SlotsMateModels\Filters\Author\AuthorFilter;

use Hlis\GlobalModels\DAOs\AbstractEntityInfo;

class Author extends AbstractEntityInfo
{

    public function __construct(AuthorFilter $filter)
    {
        parent::__construct($filter);
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

    // protected function appendBranches(): void
    // {
    //     $this->appendSocialNetworks();
    //     $this->appendTaglines();
    // }

    protected function getBuilder(): BasicAuthorBuilder
    {
        return new BasicAuthorBuilder();
    }

    protected function getQuerier(): AuthorBaseQuery
    {
        return new AuthorBaseQuery($this->filter);
    }

    // protected function appendSocialNetworks(): void
    // {
    //     $social_networks = new SocialNetworks($this->filter);
    //     $this->entity->social_networks[] = $social_networks->getList();
    // }

    // protected function appendTaglines(): void
    // {
    //     $taglines = new Taglines($this->filter);
    //     $this->entity->taglines[] = $taglines->getList();
    // }

}