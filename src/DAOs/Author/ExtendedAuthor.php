<?php

namespace Hlis\SlotsMateModels\DAOs\Author;

use Hlis\SlotsMateModels\DAOs\Author\Author as BasicAuthor;
use Hlis\SlotsMateModels\Queries\Author\AuthorExtendedQuery;
use Hlis\SlotsMateModels\Builders\Author\Info\Extended as ExtendedAuthorBuilder;

/*
 *
 * Extended DAO is used for single author page & single game page where we need expertise, hightlights and full bio
 * We will have to extend global models for articles and games as well in the future and extend this DAO as well to get the games & articles for each author
 * For now this will not be used, but instead we use what we already have on the site (Author DAO) for appending these features
 *
 * */

class ExtendedAuthor extends BasicAuthor
{

    protected function getQuerier(): AuthorExtendedQuery
    {
        return new AuthorExtendedQuery($this->filter);
    }

    protected function getBuilder(): ExtendedAuthorBuilder
    {
        return new ExtendedAuthorBuilder();
    }

}