<?php

namespace Hlis\SlotsMateModels\Queries\Author\FieldsSetter;

use Hlis\GlobalModels\Queries\AbstractFields;

class SocialNetworksFields extends AbstractFields
{

    public function appendFields(Fields $fields): void
    {
        $fields->add("t2.link");
        $fields->add("t3.name");
        $fields->add("t3.priority");
    }

}