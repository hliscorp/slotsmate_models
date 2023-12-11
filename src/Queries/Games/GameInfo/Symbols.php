<?php

namespace Hlis\SlotsMateModels\Queries\Games\GameInfo;

use Hlis\GlobalModels\Queries\Games\GameInfo\Symbols as GlobalSymbols;

class Symbols extends GlobalSymbols
{
    protected function setFields(): void
    {
        $fields = $this->query->fields();
        $fields->add("t1.logo_id", "file_name");
    }
}