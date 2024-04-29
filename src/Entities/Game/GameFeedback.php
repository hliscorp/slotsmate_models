<?php

namespace Hlis\SlotsMateModels\Entities\Game;

use Hlis\SlotsMateModels\Entities\Feedback;

class GameFeedback extends Feedback
{
    public ?string $ip = null;
    public ?array $images = null;
}