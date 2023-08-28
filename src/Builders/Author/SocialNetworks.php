<?php

namespace Hlis\SlotsMateModels\Builders\Author;

use \Hlis\GlobalModels\Builders\ExtendableBuilder;
use Hlis\SlotsMateModels\Entities\Author\SocialNetwork as SocialNetworkEntity;

class SocialNetworks extends ExtendableBuilder
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