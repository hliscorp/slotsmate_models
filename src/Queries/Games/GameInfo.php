<?php

namespace Hlis\SlotsMateModels\Queries\Games;

use Hlis\GlobalModels\Queries\Games\GameInfo as GlobalGameInfoQuery;
use Lucinda\Query\Clause\Fields;

class GameInfo extends GlobalGameInfoQuery
{
    protected function setFields(Fields $fields): void
    {
        $setter = new FieldsSetter\GameInfoFields($this->filter);
        $setter->appendFields($fields);
    }

    protected function setJoins(): void
    {
        new JoinsSetter\GameInfoJoins($this->filter, $this->query);
    }
}