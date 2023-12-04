<?php

namespace Hlis\SlotsMateModels\Builders\Casino;

use Hlis\GlobalModels\Builders\Builder;
use Hlis\SlotsMateModels\Entities\Casino\Rating as RatingEntity;

class Rating implements Builder
{
    public function build(array $row): \Entity
    {
        $rating = new RatingEntity();
        $rating->votes = $row["rating_votes"];
        $rating->total = $row["rating_total"];
        $rating->rating = $rating->votes == 0 ? 0 :  round($rating->total/$rating->votes);
        return $rating;
    }
}