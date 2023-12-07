<?php

namespace Hlis\SlotsMateModels\DAOs\Games;

use Hlis\GlobalModels\Entities\Game\Paytable;
use Hlis\GlobalModels\Filters\Game as GamesFilter;
use Hlis\GlobalModels\Queries\Games\GameInfo\Paytable as PaytableQuery;
use Hlis\GlobalModels\Queries\Games\GameInfo\Scatter as ScatterQuery;

use Hlis\SlotsMateModels\Builders\Game\Paytable as PaytableBuilder;
use Hlis\SlotsMateModels\Queries\Games\GameInfo\Wild as WildQuery;
use Hlis\SlotsMateModels\Queries\Games\GameInfo\PaytableGallery as SlotsmatePaytableGalleryQuery;
use Hlis\SlotsMateModels\Queries\Games\GameInfo\Symbols as SymbolsQuery;

class GamePaytable extends \Hlis\GlobalModels\DAOs\Games\GamePaytable
{

    protected function setPaytable(): void
    {
        $symbolsQuery = new SymbolsQuery($this->filter);
        $symbolsResults = \SQL($symbolsQuery->getQuery(), $symbolsQuery->getParameters())->toList();

        $paytableQuery = new PaytableQuery($this->filter);
        $paytableResults = \SQL($paytableQuery->getQuery(), $paytableQuery->getParameters())->toList();

        $wildQuery = new WildQuery($this->filter);
        $wildResults = \SQL($wildQuery->getQuery(), $wildQuery->getParameters())->toList();



        $galleryQuery = new SlotsmatePaytableGalleryQuery($this->filter);
        $galleryResults = \SQL($galleryQuery->getQuery(), $galleryQuery->getParameters())->toList();

        $paytableBuilder = new PaytableBuilder();
        $this->paytable = $paytableBuilder->build([
            'symbols'=>$symbolsResults,
            'paytable'=>$paytableResults,
            'wild'=>$wildResults,
            'gallery'=>$galleryResults
        ]);
    }

}