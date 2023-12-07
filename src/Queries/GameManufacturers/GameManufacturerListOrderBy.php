<?php

namespace Hlis\SlotsMateModels\Queries\GameManufacturers;

use Hlis\GlobalModels\Queries\AbstractOrderBy;
use Hlis\SlotsMateModels\Enums\GameManufacturersOrderBy;
use Lucinda\Query\Operator\OrderBy;

class GameManufacturerListOrderBy extends AbstractOrderBy
{
    protected function setByAlias(string $orderByAlias): void
    {
        switch ($orderByAlias) {
                case GameManufacturersOrderBy::MAIN:
                    $this->orderBy->add("t1.main", OrderBy::DESC);
                    $this->orderBy->add("t1.priority", OrderBy::DESC);
                    $this->orderBy->add("nr", OrderBy::DESC);
                    $this->orderBy->add("t1.id");
                    break;
                case GameManufacturersOrderBy::PRIORITY:
                    $this->orderBy->add("t1.priority", OrderBy::DESC);
                    $this->orderBy->add("nr", OrderBy::DESC);
                    $this->orderBy->add("t1.id");
                break;
        }
    }
}
