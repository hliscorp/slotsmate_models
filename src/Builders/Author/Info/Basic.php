<?php

namespace Hlis\SlotsMateModels\Builders\Author\Info;

use \Hlis\GlobalModels\Builders\ExtendableBuilder;
use Hlis\SlotsMateModels\Entities\Author\Author as AuthorEntity;

class Basic extends ExtendableBuilder
{

    public function build(array $row): \Entity
    {

        $author = $this->getEntity();

        $author->id = $row['id'];
        $author->name = $row['first_name'].' '.$row['last_name'];
        $author->tagline = $row['tagline'];
        $author->highlights = $row['highlights'];
        $author->date_joined = $row['date_joined'];

        return $author;

    }

    protected function getEntity(): \Entity
    {
        return new AuthorEntity();
    }

}