<?php

namespace   Hlis\SlotsMateModels\Queries\Author\FieldsSetter;

use Hlis\GlobalModels\Queries\AbstractFields;

class TaglinesFields extends AbstractFields
{

    public function appendFields(Fields $fields): void
    {
        $fields->add("t4.tagline");
        $fields->add("t4.locale_id");
    }

}