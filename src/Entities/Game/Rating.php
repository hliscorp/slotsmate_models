<?php

namespace Hlis\SlotsMateModels\Entities\Game;

class Rating extends \Entity
{
    public ?float $averageScore = null;
    public ?int $votes = null;
    public ?array $scoreBreakdown = null;
}