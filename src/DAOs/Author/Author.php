<?php

namespace Hlis\SlotsMateModels\DAOs\Author;

use Hlis\SlotsMateModels\Entities\Author as AuthorEntity;
use Hlis\SlotsMateModels\Builders\Author\Info\Basic as BasicAuthorBuilder;
use Hlis\SlotsMateModels\Builders\Author\Info\Extended as ExtendedAuthorBuilder;
use Hlis\SlotsMateModels\Queries\Author\AuthorQuery;
use Hlis\GlobalModels\DAOs\AbstractEntityInfo;

class Author extends AbstractEntityInfo
{

    protected function createTrunks(): ?AuthorEntity
    {
        $builder = new AuthorBuilder();
        $querier = new AuthorQuery($this->filter);
        $row = SQL($querier->getQuery(), $querier->getParameters())->toRow();

        if (empty($row)) {
            return null;
        }

        return $builder->build($row);
    }

    protected function appendBranches(): void
    {
        $this->appendReviewedGames();
        $this->appendLearningArticles();
        $this->appendNewsArticles();
        $this->appendGamesImpressions();
    }

    private function appendReviewedGames()
    {

    }

    private function appendLearningArticles()
    {

    }

    private function appendNewsArticles()
    {

    }

    private function appendGamesImpressions()
    {

    }

}