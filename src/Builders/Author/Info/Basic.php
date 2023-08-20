<?php

namespace Hlis\SlotsMateModels\Builders\Author\Info;

use Hlis\SlotsMateModels\Entities\Author;

class Basic
{

    public function build(array $row): \Entity
    {

        $author = new Author();

        $author->id = $row['id'];
        $author->name = $row['first_name'].' '.$row['last_name'];
        $author->avatar = $row['avatar'];
        $author->highlights = $row['highlights'];
        $author->tagline = $row['tagline'];
        $author->socials = $row['social_links'];
        $author->date_joined = $row['date_joined'];

        return $author;

    }

}