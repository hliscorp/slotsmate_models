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
                $filter = $this->filter->getBonus();
                if ($filter !== null && $filter->getTargetCountry()) {
                    //if that is targeted casinos query this order by is way more complicated, we need to take amount_fs for order from the proper casino bonus
                    $this->orderBy->add(
                        "COALESCE(
                            MAX(CASE WHEN cbtargetst23.targeted = 1 THEN t22.amount_fs ELSE null END),
                            MAX(CASE WHEN t22.client_id = 12 THEN t22.amount_fs ELSE null END),
                            MAX(CASE WHEN cbtargetst23.targeted = 0 THEN t22.amount_fs ELSE null END)
                        )"
                    );
                } else {
                    $this->orderBy->add("MAX(t22.amount_fs)");
                }
                $this->orderBy->add("t1.priority", OrderBy::DESC)
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