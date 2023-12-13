<?php

namespace Hlis\SlotsMateModels\Queries\Games;

use Hlis\SlotsMateModels\Enums\GameSortCriteria;
use Hlis\GlobalModels\Queries\AbstractOrderBy;
use Lucinda\Query\Operator\OrderBy;

class GamesListSearchOrderBy extends AbstractOrderBy
{
    protected function setByAlias(string $orderByAlias): void
    {
        switch ($orderByAlias) {
            case GameSortCriteria::NEWEST:
                $this->orderBy->add('date_launched', OrderBy::DESC)
                    ->add('t1.id', OrderBy::DESC);
                break;
            case GameSortCriteria::MOST_PLAYED:
                $this->orderBy->add('likes_percents', OrderBy::DESC)
                    ->add('t1.priority', OrderBy::DESC)
                    ->add('t1.id', OrderBy::DESC);
                break;
            case GameSortCriteria::RTP:
                $this->orderBy->add('rtp', OrderBy::DESC)
                    ->add('t1.id', OrderBy::DESC);
                break;
            case GameSortCriteria::COUNTER:
                $this->orderBy->add('times_played', OrderBy::DESC)
                    ->add('t1.priority', OrderBy::ASC)
                    ->add('t1.id', OrderBy::DESC);
                break;
            default:
                $this->orderBy->add('t1.priority', OrderBy::DESC)
                    ->add('t1.id', OrderBy::DESC);
                break;
        }
    }
}