<?php

namespace Hlis\SlotsMateModels\Queries\LearnArticles\FieldsSetter;

use Hlis\GlobalModels\Queries\AbstractFields;
use Lucinda\Query\Clause\Fields;

class LearnArticleFields extends AbstractFields
{

    public function appendFields(Fields $fields): void
    {
        $fields->add("t1.id");
        $fields->add("t1.writer_id");
        $fields->add("t1.title");
        $fields->add("t1.is_deleted");
        $fields->add("t1.date_added");
    }

}