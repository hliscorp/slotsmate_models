<?php

namespace Hlis\SlotsMateModels\Queries\Author\FieldsSetter;

use Hlis\SlotsMateModels\Queries\Author\FieldsSetter\AuthorFields;
use Lucinda\Query\Clause\Fields;

class ExtendedAuthorFields extends AuthorFields
{

    public function appendFields(Fields $fields): void
    {
        parent::appendFields($fields);
        $fields->add("t5.expertise");
        $fields->add("t6.highlights");
        $fields->add("t7.full_bio");
    }

}