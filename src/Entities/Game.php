<?php

namespace Hlis\SlotsMateModels\Entities;

use Hlis\GlobalModels\Entities\Game as GlobalGameEntity;
use Hlis\SlotsMateModels\Entities\Game\Rating;

class Game extends GlobalGameEntity
{
    public ?Rating $rating = null;
    public ?float $score = null;
    public ?int $timesPlayed = null;
    public ?int $max_win_pl = null;
    public ?float $rtp = null;
    public ?int $noindex = null;
    public ?bool $is_best = null;
    public ?bool $is_hot = null;
    public ?bool $is_mobile = null;
}