<?php

namespace Hlis\SlotsMateModels\Queries\Games\GameInfo;

class HowToPlay extends \Hlis\GlobalModels\Queries\Games\GameInfo\HowToPlay
{
    protected function setFields(): void
    {
        $fields = $this->query->fields();
        $fields->add("t1.step");
        $fields->add("t1.title");
        $fields->add("t1.body");
        $fields->add("t1.gif_id");
        $fields->add("t1.logo_id", "file_name");
    }

    protected function setJoins(): void
    {

    }

}