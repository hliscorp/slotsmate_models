<?php

namespace Hlis\SlotsMateModels\Queries\Casinos;

use Hlis\SlotsMateModels\Enums\CasinoSortCriteria;
use Hlis\GlobalModels\Queries\AbstractOrderBy;
use Lucinda\Query\Operator\OrderBy;

class CasinoListOrderBy extends AbstractOrderBy
{
    protected function setByAlias(string $orderByAlias): void
    {
        switch ($orderByAlias) {
            case CasinoSortCriteria::NEWEST:
                $this->orderBy->add("t1.date_established", OrderBy::DESC)
                    ->add("t1.priority", OrderBy::DESC);
                break;
            case CasinoSortCriteria::FREE_BONUS:
                // cast free_bonus_amount to int
                $this->orderBy->add("free_bonus_amount+0", OrderBy::DESC)
                    ->add("has_first_deposit_bonus ", OrderBy::DESC)
                    ->add("t1.priority", OrderBy::DESC);
                break;
            case CasinoSortCriteria::TOP_RATED:
                $this->orderBy->add("(t1.rating_total/t1.rating_votes)", OrderBy::DESC)
                    ->add("t1.priority", OrderBy::DESC)
                    ->add("t1.id", OrderBy::DESC);
                break;
            case CasinoSortCriteria::POPULARITY:
                $this->orderBy->add("t1.clicks", OrderBy::DESC)
                    ->add("t1.id", OrderBy::DESC);
                break;
            case CasinoSortCriteria::RELEVANT:
                $this->orderBy->add("country_accepted", OrderBy::DESC)
                    ->add("t1.priority", OrderBy::DESC)
                    ->add("t1.id", OrderBy::DESC);
                break;
            case CasinoSortCriteria::PRIORITY_NEWEST:
                $this->orderBy->add("t1.priority", OrderBy::DESC)
                    ->add("t1.date_established", OrderBy::DESC)
                    ->add("t1.id", OrderBy::DESC);
                break;
            case CasinoSortCriteria::AMOUNT_FS_PRIORITY:
                $this->orderBy->add("t22.client_id", OrderBy::DESC)
                    ->add("cbtargetst23.targeted", OrderBy::DESC)
                    ->add("t22.amount_fs")
                    ->add("t1.priority", OrderBy::DESC)
                    ->add("t1.id", OrderBy::DESC);
                break;
            case CasinoSortCriteria::NONE:
                $this->orderBy->add("t1.priority", OrderBy::DESC)
                    ->add("t1.id", OrderBy::DESC);
                break;
            default:
                throw new \InvalidArgumentException("Invalid sort criteria: " . $orderByAlias);
        }
    }
}