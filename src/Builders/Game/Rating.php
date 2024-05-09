<?php

namespace Hlis\SlotsMateModels\Builders\Game;

use Hlis\GlobalModels\Builders\Builder;
use Hlis\SlotsMateModels\Entities\Game\Rating as RatingEntity;

class Rating implements Builder
{
    public function build(array $row): RatingEntity
    {
        $rating = new RatingEntity();
        $votes = $total = 0;
        $breakdown = [1=>0,2=>0,3=>0,4=>0,5=>0];
        foreach ($row as $vote) {
            $breakdown[$vote]++;
            $votes++;
            $total += $vote;
        }
        $rating->averageScore = $votes ? round($total / $votes, 1) : 0;
        $rating->votes = $votes;
        $rating->scoreBreakdown = $breakdown;
        return $rating;
    }
}
