<?php
namespace Hlis\SlotsMateModels\Queries\Casinos;

use Hlis\SlotsMateModels\Enums\Clients;
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
                    ->add("t1.priority", OrderBy::DESC)
                    ->add("t1.id", OrderBy::DESC);
                break;
            case CasinoSortCriteria::FREE_BONUS:
                // cast free_bonus_amount to int
                $this->orderBy->add("free_bonus_amount+0", OrderBy::DESC)
                    ->add("has_first_deposit_bonus", OrderBy::DESC)
                    ->add("t1.priority", OrderBy::DESC)
                    ->add("t1.id", OrderBy::DESC);
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
                $this->setBonusFsAmountOrder();
                $this->orderBy->add("t1.priority", OrderBy::DESC)
                    ->add("t1.id", OrderBy::DESC);
                break;
            case CasinoSortCriteria::NONE:
                $this->orderBy->add("t1.priority", OrderBy::DESC)
                    ->add("t1.id", OrderBy::DESC);
                break;
            case CasinoSortCriteria::GEO_PRIORITY:
                $this->setGeoPriorityOrder();
                break;
            case CasinoSortCriteria::MINIMUM_DEPOSIT_GEO_PRIORITY:
                if($this->filter->getDepositRange() && $this->filter->getCurrencies() && $this->filter->getSelectedCountry()) {
                    $this->orderBy->add("cmd.value");
                } else {
                    $this->orderBy->add("t1.deposit_minimum");
                }
                $this->setGeoPriorityOrder();
                break;
            case CasinoSortCriteria::AMOUNT_FS_GEO_PRIORITY:
                $this->setBonusFsAmountOrder();
                $this->setGeoPriorityOrder();
                break;
            case CasinoSortCriteria::WITHDRAW_TIME_GEO_PRIORITY:
                $this->orderBy->add("MIN(cwt.end * IF(cwt.unit = 'hour', 3600, 86400))");
                $this->setGeoPriorityOrder();
                break;
            case CasinoSortCriteria::HAS_APP_GEO_PRIORITY:
                $this->orderBy->add("
                    (
                      SELECT 1
                      FROM casinos__operating_systems
                      WHERE casino_id = t1.id AND is_app = 1
                      LIMIT 1
                   ) IS NULL"
                );
                $this->setGeoPriorityOrder();
                break;
            case CasinoSortCriteria::HAS_TARGETED_BONUS_GEO_PRIORITY:
                $this->orderBy->add("cbt.client_id IS NULL");
                $this->orderBy->add("cbt.client_id", OrderBy::DESC);
                $this->setGeoPriorityOrder();
                break;
            default:
                throw new \InvalidArgumentException("Invalid sort criteria: " . $orderByAlias);
        }
    }

    protected function setGeoPriorityOrder(): void
    {
        $this->orderBy
            ->add('
                CASE WHEN cp.country_id IS NOT NULL THEN IF(cp.client_id=' . Clients::SLOTSMATE . ',1,2)
                WHEN cp1.country_id IS NOT NULL THEN IF(cp1.client_id=' . Clients::SLOTSMATE . ',3,4)
                ELSE 5 END')
            ->add('cp.value', OrderBy::DESC)
            ->add('cp1.value', OrderBy::DESC)
            ->add("t1.id", OrderBy::DESC);
    }

    protected function setBonusFsAmountOrder(): void
    {
        $filter = $this->filter->getBonus();
        if ($filter !== null && $filter->getTargetCountry()) {
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

    }
}