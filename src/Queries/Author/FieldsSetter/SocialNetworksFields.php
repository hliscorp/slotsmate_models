<?php

namespace Hlis\SlotsMateModels\Queries\Author\FieldsSetter;

use Hlis\GlobalModels\Queries\AbstractFields;
use Lucinda\Query\Clause\Fields;

class SocialNetworksFields extends AbstractFields
{

    public function appendFields(Fields $fields): void
    {
        $fields->add("t2.id");
        $fields->add("t2.author_id");
        $fields->add("t2.social_network_id");
        $fields->add("t2.link");
        $fields->add("t3.name");
        $fields->add("t3.priority");
    }

}