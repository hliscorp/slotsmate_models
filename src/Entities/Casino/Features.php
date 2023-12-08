<?php

namespace Hlis\SlotsMateModels\Entities\Casino;

use \Hlis\GlobalModels\Entities\Casino\Features as GlobalFeatures;

class Features extends GlobalFeatures
{
    public ?int $isLiveDealer = null;
}