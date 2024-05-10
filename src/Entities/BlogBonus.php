<?php

namespace Hlis\SlotsMateModels\Entities;

use Hlis\GlobalModels\Entities\BlogBonus as GlobalBlogBonus;

class BlogBonus extends GlobalBlogBonus
{
    public ?bool $isBonusAllowedByUserCountry = null; // from bonuses__countries_allowed table
}