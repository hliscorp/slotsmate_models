<?php

namespace Hlis\SlotsMateModels\DAOs\Games\Feedbacks;

use Hlis\SlotsMateModels\Queries\Feedbacks\GameFeedbacksTotal as GameFeedbacksTotalQuery;
use Hlis\GlobalModels\DAOs\AbstractEntityTotal;
use Hlis\GlobalModels\Queries\Query;

class GameFeedbacksTotal extends AbstractEntityTotal
{
    protected function getQuery(): Query
    {
        return new GameFeedbacksTotalQuery($this->filter);
    }

}