<?php

namespace Hlis\SlotsMateModels\Builders\LearnArticles;

use \Hlis\GlobalModels\Builders\ExtendableBuilder;
use Hlis\SlotsMateModels\Entities\LearnArticles\LearnArticle as LearnArticleEntity;

class LearnArticle extends ExtendableBuilder
{

    public function build(array $row): \Entity
    {

        $article = $this->getEntity();

        $article->id = $row['id'];
        $article->link = $row['url'];
        $article->title = $row['title'];
        $article->writer_id = $row['writer_id'];

        return $article;

    }

    protected function getEntity(): \Entity
    {
        return new LearnArticleEntity();
    }

}