<?php

namespace Hlis\SlotsMateModels\DAOs\Author;

use Hlis\SlotsMateModels\DAOs\Author\Author as BasicAuthor;
use Hlis\SlotsMateModels\Builders\Author\Info\Extended as ExtendedAuthorBuilder;

/*
 * Extended DAO is used for single author page
 * */

class ExtendedAuthor extends BasicAuthor
{

    protected function appendBranches(): void
    {
        parent::appendBranches();
        $this->appendGameReviews();
        $this->appendLearningArticles();
        $this->appendNewsArticles();
        $this->appendGameImpressions();
    }

    private function appendGameReviews()
    {

    }

    private function appendLearningArticles()
    {

    }

    private function appendNewsArticles()
    {

    }

    private function appendGameImpressions()
    {

    }

    protected function getBuilder(): ExtendedAuthorBuilder
    {
        return new ExtendedAuthorBuilder();
    }

}