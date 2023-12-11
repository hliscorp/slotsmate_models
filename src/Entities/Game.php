<?php

namespace Hlis\SlotsMateModels\Entities;

use Hlis\ChipyModels\Entities\Game\FAQItem as FAQItem;
use Hlis\ChipyModels\Entities\Game\Label as GameLabel;
use Hlis\GlobalModels\Entities\BlogBonus;
use Hlis\GlobalModels\Entities\Game as GlobalGameEntity;

class Game extends GlobalGameEntity
{
    public ?float $rating = null;
    public ?float $score = null;
    public ?int $timesPlayed = null;
    public ?int $max_win_pl = null;

}