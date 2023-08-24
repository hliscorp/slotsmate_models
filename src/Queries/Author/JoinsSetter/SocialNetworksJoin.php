<?php

namespace Hlis\SlotsMateModels\Queries\Author\JoinsSetter;

use \Hlis\GlobalModels\Queries\AbstractJoins;

class SocialNetworksJoin extends AbstractJoins
{

    public function appendJoins(): void
    {
        $this->appendSocialNetworksJoin();
    }

    protected function appendSocialNetworksJoin(): void
    {
        $this->query->joinLeft("social_networks", "t3")->on(["t2.social_network_id"=>"t3.id"]);
    }

    protected function getLinkingColumnName(): string
    {
        return "social_network_id";
    }

}