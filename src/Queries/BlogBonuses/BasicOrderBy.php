<?php

namespace Hlis\SlotsMateModels\Queries\BlogBonuses;

use Hlis\GlobalModels\Queries\BlogBonuses\BasicOrderBy as GlobalBasicOrderBy;
use Hlis\SlotsMateModels\Enums\BonusesSortCriteria;
use Lucinda\Query\Operator\OrderBy;

class BasicOrderBy extends GlobalBasicOrderBy
{
    protected function setByAlias(string $orderByAlias): void
    {
        switch ($orderByAlias) {
            case BonusesSortCriteria::GAMES_BONUSES:
                $this->orderBy->add("is_free");
                if ($this->filter->getSelectedCountry() || $this->filter->getUserCountry()) {
                    $this->orderBy->add("is_allowed_by_user_country", OrderBy::DESC);
                }
                $this->orderBy->add("t1.minimum_deposit");
                $this->orderBy->add("t1.date_modified", OrderBy::DESC);
                break;
            case BonusesSortCriteria::IS_ALLOWED_IN_COUNTRY_NEWEST:
                if ($this->filter->getSelectedCountry() || $this->filter->getUserCountry()) {
                    $this->orderBy->add("is_allowed_by_user_country", OrderBy::DESC);
                }
                $this->orderBy->add("t1.id", OrderBy::DESC);
                break;
            default:
                parent::setByAlias($orderByAlias);
        }
    }
}