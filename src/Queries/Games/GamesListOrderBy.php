<?php

namespace Hlis\SlotsMateModels\Queries\Games;

use Hlis\SlotsMateModels\Enums\GameSortCriteria;
use Hlis\GlobalModels\Queries\AbstractOrderBy;
use Lucinda\Query\Operator\OrderBy;

class GamesListOrderBy extends AbstractOrderBy
{
    protected function setByAlias(string $orderByAlias): void
    {
        switch ($orderByAlias) {
            case GameSortCriteria::NONE:
                $this->orderBy->add('t1.priority', OrderBy::DESC)
                    ->add('t1.id', OrderBy::DESC);
                break;
            case GameSortCriteria::NEWEST:
                $this->orderBy->add('has_demo', OrderBy::DESC)
                              ->add("t1.date_launched", OrderBy::DESC)
                              ->add("t1.id", OrderBy::DESC);
                break;
                break;
            case GameSortCriteria::BEST:
                $this->orderBy->add('gv.score', OrderBy::DESC);
                $this->orderBy->add('gv.votes', OrderBy::DESC)
                    ->add('t1.id', OrderBy::DESC);
                break;
            case GameSortCriteria::MOST_PLAYED:
                $this->orderBy->add('gv.score', OrderBy::DESC)
                    ->add('t1.priority', OrderBy::DESC)
                    ->add('t1.id', OrderBy::DESC);
                break;
            case GameSortCriteria::RTP:
                $this->orderBy->add('rtp', OrderBy::DESC)
                    ->add('gm.priority', OrderBy::DESC)
                    ->add('t1.id', OrderBy::DESC);
                break;
            case GameSortCriteria::COUNTER:
                $this->orderBy->add('has_demo', OrderBy::DESC)
                    ->add('t1.times_played', OrderBy::DESC)
                    ->add('t1.priority', OrderBy::ASC)
                    ->add('t1.id', OrderBy::DESC);
                break;
            case GameSortCriteria::DATE_ASC:
                $this->orderBy->add('date_launched', OrderBy::ASC)
                    ->add('t1.priority', OrderBy::ASC)
                    ->add('t1.id', OrderBy::DESC);
                break;
            case GameSortCriteria::DATE_DESC:
                $this->orderBy->add('date_launched', OrderBy::DESC)
                    ->add('t1.priority', OrderBy::ASC)
                    ->add('t1.id', OrderBy::DESC);
                break;
            case GameSortCriteria::DEMO:
                $this->orderBy->add('has_demo', OrderBy::DESC)
                    ->add('t1.priority', OrderBy::ASC)
                    ->add('t1.id', OrderBy::DESC);
                break;
            case GameSortCriteria::RELEVANT:
                $this->orderBy->add('t1.priority', OrderBy::DESC)
                    ->add('t1.times_played', OrderBy::ASC)
                    ->add('t1.id', OrderBy::DESC);
                break;
            default:
                throw new \InvalidArgumentException("Invalid sort criteria: " . $orderByAlias);
        }

    }
}
