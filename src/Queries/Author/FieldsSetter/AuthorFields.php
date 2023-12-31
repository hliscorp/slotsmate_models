<?php

namespace Hlis\SlotsMateModels\Queries\Author\FieldsSetter;

use Hlis\GlobalModels\Queries\AbstractFields;
use Lucinda\Query\Clause\Fields;

class AuthorFields extends AbstractFields
{

    public function appendFields(Fields $fields): void
    {
        $fields->add("t1.id");
        $fields->add("t1.first_name");
        $fields->add("t1.last_name");
        $fields->add("t1.date_joined");
        $fields->add("t4.tagline");
        $fields->add("t6.highlights");
    }

}