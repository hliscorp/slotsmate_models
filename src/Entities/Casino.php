<?php

namespace Hlis\SlotsMateModels\Entities;

use Hlis\SlotsMateModels\Entities\Casino\Rating;
use Hlis\GlobalModels\Entities\Casino as DefaultCasino;

class Casino extends DefaultCasino
{
    public ?Rating $rating = null;
    public ?int $reviewsCount = 0;
    public array $acceptableBonusesIds = [];
}
