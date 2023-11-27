<?php

namespace Hlis\SlotsMateModels\Entities\Game;

use Hlis\GlobalModels\Entities\Game\Type as DefaultType;

class Type extends DefaultType
{
    public ?bool $isRegular = null;
    public ?bool $isLive = null;
    public ?bool $isVR = null;
}