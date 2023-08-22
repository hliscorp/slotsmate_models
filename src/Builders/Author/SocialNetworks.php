<?php

namespace Hlis\SlotsMateModels\Builders\Author\Info;

use Hlis\GlobalModels\Builders\ExtendableBuilder;
use Hlis\SlotsMateModels\Entities\Author\SocialNetwork;

class SocialNetworks extends ExtendableBuilder
{

    public function build(array $row): \Entity
    {

        $social = new SocialNetwork();

        $social->id = $row['id'];
        $social->link = $row['link'];
        $social->name = $row['name'];

        return $social;

    }

}