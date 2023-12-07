<?php

namespace Hlis\SlotsMateModels\Builders\Game;

use Hlis\GlobalModels\Builders\Game\Paytable\Symbol as SymbolBuilder;

class Paytable extends \Hlis\GlobalModels\Builders\Game\Paytable
{
    protected function buildSymbols(array $row): void
    {
        $symbolBuilder = new SymbolBuilder();
        foreach ($row['symbols'] as $symbol) {
            $this->paytable->symbols[] = $symbolBuilder->build($symbol);
        }
    }

    protected function buildWild(array $row): void
    {
        foreach ($row['wild'] as $wild) {
            $this->paytable->wild[] = $wild['file_name'];
        }
    }

    protected function buildScatter(array $row): void
    {
        // do nothing
    }

}

