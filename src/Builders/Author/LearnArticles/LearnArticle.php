<?php

namespace Hlis\SlotsMateModels\Builders\LearnArticles;

use \Hlis\GlobalModels\Builders\ExtendableBuilder;
use Hlis\SlotsMateModels\Entities\LearnArticles\LearnArticle as LearnArticleEntity;

class LearnArticles extends ExtendableBuilder
{

    public function build(array $row): \Entity
    {

        $social = $this->getEntity();

        $social->id = $row['social_network_id'];
        $social->link = $row['link'];
        $social->name = $row['name'];
        $social->priority = $row['priority'];

        return $social;

    }

    protected function getEntity(): \Entity
    {
        return new SocialNetworkEntity();
    }

}