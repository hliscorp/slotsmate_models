<?php

namespace Hlis\SlotsMateModels\Builders\Author\Info;

use Hlis\GlobalModels\Builders\ExtendableBuilder;
use Hlis\SlotsMateModels\Entities\Author\Tagline;

class Taglines extends ExtendableBuilder
{

    public function build(array $row): \Entity
    {

        $tagline = new Tagline();

        $tagline->id = $row['id'];
        $tagline->locale_id = $row['locale_id'];
        $tagline->tagline = $row['tagline'];

        return $tagline;

    }

}