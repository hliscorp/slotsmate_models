<?php

namespace Hlis\SlotsMateModels\Builders\Author\Info;

class Extended extends Basic
{

    public function build(array $row): AuthorEntity
    {

        $author = parent::build($row);

        $author->full_bio = $row['full_bio'];
        // $author->expertise = $row['expertise'];

        return $author;

    }

}