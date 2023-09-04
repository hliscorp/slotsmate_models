<?php

namespace Hlis\SlotsMateModels\DAOs\Author;

use Hlis\SlotsMateModels\DAOs\Author\Author as BasicAuthor;
use Hlis\SlotsMateModels\Builders\Author\Info\Extended as ExtendedAuthorBuilder;


/*
 *
 * Extended DAO is used for single author page
 * We will have to extend global models for articles and games as well in the future
 * For now this will not be used, but instead we use what we already have on the site (Author DAO) for appending these features
 *
 * */

class ExtendedAuthor extends BasicAuthor
{

   protected function appendBranches(): void
   {
       parent::appendBranches();
   }

//    private function appendGameReviews(): void
//    {
//        $game_reviews = new GameReviews($this->filter);
//        $this->entity->game_reviews[] = $game_reviews->getList();
//    }

//    private function appendNewsArticles(): void
//    {
//        $news_articles = new NewsArticles($this->filter);
//        $this->entity->news_articles[] = $news_articles->getList();
//    }

//    private function appendGameImpressions(): void
//    {
//        $game_impressions = new GameImpressions($this->filter);
//        $this->entity->game_impressions[] = $game_impressions->getList();
//    }

    protected function getBuilder(): ExtendedAuthorBuilder
    {
        return new ExtendedAuthorBuilder();
    }

}