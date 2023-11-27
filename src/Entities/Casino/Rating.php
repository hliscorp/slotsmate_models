<?php

namespace Hlis\SlotsMateModels\Entities\Casino;

class Rating extends \Entity
{
    public ?int $votes = null;
    public ?int $total = null;
    public ?int $rating = null;
}