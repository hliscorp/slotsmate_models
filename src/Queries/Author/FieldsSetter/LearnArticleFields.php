<?php

namespace Hlis\SlotsMateModels\Queries\Author\FieldsSetter;

use Hlis\GlobalModels\Queries\AbstractFields;
use Lucinda\Query\Clause\Fields;

class LearnArticleFields extends AbstractFields
{

    public function appendFields(Fields $fields): void
    {
        $fields->add("l.id");
        $fields->add("l.writer_id");
        $fields->add("l.title");
        $fields->add("l.is_deleted");
        $fields->add("l.date_added");
    }

}