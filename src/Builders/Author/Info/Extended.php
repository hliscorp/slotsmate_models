<?php

namespace Hlis\SlotsMateModels\Builders\Author\Info;

use Hlis\SlotsMateModels\Builders\Author\Info\Basic;
use Hlis\SlotsMateModels\Entities\Author\Author as AuthorEntity;

class Extended extends Basic
{

    public function build(array $row): AuthorEntity
    {

        $author = parent::build($row);

        $author->full_bio = $row['full_bio'];
        $author->expertise = $row['expertise'];

        return $author;

    }

}