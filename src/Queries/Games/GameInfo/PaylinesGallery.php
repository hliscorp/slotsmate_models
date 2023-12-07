<?php

namespace Hlis\SlotsMateModels\Queries\Games\GameInfo;

use Hlis\GlobalModels\Queries\Games\GameInfo\PaylinesGallery as GlobalPaylinesGallery;

class PaylinesGallery extends GlobalPaylinesGallery
{
    protected function setFields(): void
    {
        $fields = $this->query->fields();
        $fields->add("t1.logo_id", "file_name");
    }
}