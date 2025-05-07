<?php

namespace Hlis\SlotsMateModels\DAOs\Casinos;

use Hlis\SlotsMateModels\Builders\Casino\Bonus\Basic as CasinoBonusBuilder;
use Hlis\SlotsMateModels\Builders\Casino\DepositMinimumTargeted;
use Hlis\SlotsMateModels\Builders\Casino\Info\Basic as CasinoBuilder;
use Hlis\SlotsMateModels\Builders\Casino\Rating as RatingBuilder;
use Hlis\SlotsMateModels\Builders\Casino\Language as LanguageBuilder;
use Hlis\SlotsMateModels\Builders\Casino\WithdrawMinimumTargeted;
use Hlis\SlotsMateModels\Builders\GameManufacturer\Basic as GameManufacturerBuilder;
use Hlis\SlotsMateModels\Builders\BankingMethod\Basic as BankingMethodBuilder;
use Hlis\SlotsMateModels\Builders\GameType as GameTypeBuilder;
use Hlis\GlobalModels\Builders\Casino\WithdrawTimeframe as GlobalWithdrawTimeframeBuilder;
use Hlis\SlotsMateModels\Queries\Casinos\CasinoInfo\WithdrawTimeframes as WithdrawTimeframesQuery;

use Hlis\SlotsMateModels\Queries\Casinos\CasinoList\GameTypes as GameTypesQuery;
use Hlis\SlotsMateModels\Queries\Casinos\CasinoList\RatingInfo;
use Hlis\SlotsMateModels\Queries\Casinos\CasinoList\Bonuses;
use Hlis\SlotsMateModels\Queries\Casinos\CasinoListItems as CasinoListQuery;

use Hlis\GlobalModels\Builders\Builder;
use Hlis\GlobalModels\Builders\CountryAccess;
use Hlis\GlobalModels\Builders\LocaleText;

use Hlis\GlobalModels\Queries\Query;

use Hlis\GlobalModels\DAOs\Casinos\CasinoList as DefaultCasinoList;

class CasinoList extends DefaultCasinoList
{
    protected function createTrunks(): void
    {
        $builder = new CasinoBuilder();
        $querier = new CasinoListQuery($this->filter, $this->orderByAlias, $this->limit, $this->offset);
        $resultSet = \SQL($querier->getQuery(), $querier->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entities[$row["id"]] = $builder->build($row);
        }
    }

    protected function appendBranches(array $ids): void
    {
        parent::appendBranches($ids);

        $this->appendRatingInfo($ids);
        $this->appendBonuses($ids);
        $this->appendGameTypes($ids);
        $this->appendSoftwares($ids);
        $this->appendDepositMethods($ids);
        $this->appendWithdrawMethods($ids);
        $this->appendReviewsCount($ids);
        $this->appendLanguages($ids);
        $this->appendTargetedDepositMinimums($ids);
        $this->appendTargetedWithdrawMinimums($ids);
        $this->appendWithdrawTimeframes($ids);
    }

    protected function appendRatingInfo(array $casinoIDs): void
    {
        $builder = new RatingBuilder();
        $query = new RatingInfo($casinoIDs);
        $resultSet = \SQL($query->getQuery(), $query->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entities[$row["casino_id"]]->rating = $builder->build($row);
        }
    }

    protected function appendBonuses(array $casinoIDs): void
    {
        $builder = new CasinoBonusBuilder();
        $query = new Bonuses($casinoIDs, $this->orderByAlias);
        $resultSet = \SQL($query->getQuery(), $query->getParameters());
        $bonusIDs = [];
        while ($row = $resultSet->toRow()) {
            $tmp = $builder->build($row);
            $tmp->countries = [];
            $tmp->notes = [];
            $tmp->targets = [];
            $this->entities[$row["casino_id"]]->bonuses[$row["id"]] = $tmp;

            $bonusIDs[] = $row["id"];
        }
        if (!empty($bonusIDs)) {
            $this->appendBonusesLinks("countries", new CountryAccess(), new Bonuses\Countries($bonusIDs));
            $this->appendBonusesLinks("targets", new \Hlis\GlobalModels\Builders\Country(), new Bonuses\Targets($bonusIDs));
            $this->appendBonusesLinks("notes", new LocaleText(), new Bonuses\Notes($bonusIDs));
        }
    }

    private function appendBonusesLinks(string $parameter, Builder $builder, Query $query): void
    {
        $output = [];
        $resultSet = \SQL($query->getQuery(), $query->getParameters());
        while ($row = $resultSet->toRow()) {
            $output[$row["casino_bonus_id"]][] = $builder->build($row);
        }
        foreach ($this->entities as $entity) {
            if (empty($entity->bonuses)) {
                $entity->bonuses = [];
                continue;
            }
            foreach ($entity->bonuses as $bonusID=>$bonus) {
                if (isset($output[$bonusID])) {
                    $bonus->{$parameter} = $output[$bonusID];
                }
            }
        }
    }

    protected function appendGameTypes($casinoIDs): void
    {
        $builder = new GameTypeBuilder();
        $query = new GameTypesQuery($casinoIDs);
        $resultSet = \SQL($query->getQuery(), $query->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entities[$row["casino_id"]]->gameTypes[] = $builder->build($row);
        }
    }

    protected function appendSoftwares($ids)
    {
        $softwareBuilder = new GameManufacturerBuilder();
        $query = new \Hlis\SlotsMateModels\Queries\Casinos\CasinoList\Softwares($ids);
        $resultSet = \SQL($query->getQuery(), $query->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entities[$row["casino_id"]]->gameManufacturers[] = $softwareBuilder->build($row);
        }
    }

    protected function appendWithdrawMethods($ids)
    {
        $builder = new BankingMethodBuilder();
        $query = new \Hlis\SlotsMateModels\Queries\Casinos\CasinoList\WithdrawMethods($ids);
        $resultSet = \SQL($query->getQuery(), $query->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entities[$row["casino_id"]]->withdrawMethods[] = $builder->build($row);
        }
    }

    protected function appendDepositMethods($ids)
    {
        $builder = new BankingMethodBuilder();
        $query = new \Hlis\SlotsMateModels\Queries\Casinos\CasinoList\DepositMethods($ids);
        $resultSet = \SQL($query->getQuery(), $query->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entities[$row["casino_id"]]->depositMethods[] = $builder->build($row);
        }
    }

    protected function appendReviewsCount($ids)
    {
        $query = new \Hlis\SlotsMateModels\Queries\Casinos\CasinoList\ReviewsCount($ids);
        $resultSet = \SQL($query->getQuery(), $query->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entities[$row["casino_id"]]->reviewsCount = $row["nr"];
        }
    }

    protected function appendLanguages($ids)
    {
        $builder = new LanguageBuilder();
        $query = new \Hlis\SlotsMateModels\Queries\Casinos\CasinoList\Languages($ids);
        $resultSet = \SQL($query->getQuery(), $query->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entities[$row["casino_id"]]->languages[] = $builder->build($row);
        }
    }

    protected function appendTargetedDepositMinimums($ids)
    {
        //we will append geo targeted stuff only for the filter with selected countries
        if (!empty($this->filter->getSelectedCountry())) {
            $builder = new DepositMinimumTargeted();
            $query = new \Hlis\SlotsMateModels\Queries\Casinos\CasinoList\TargetedDepositMinimums($ids, $this->filter->getSelectedCountry());
            $resultSet = \SQL($query->getQuery(), $query->getParameters());
            while ($row = $resultSet->toRow()) {
                $this->entities[$row["casino_id"]]->depositMinimumTargeted[] = $builder->build($row);
            }
        }
    }

    protected function appendTargetedWithdrawMinimums($ids)
    {
        //we will append geo targeted stuff only for the filter with selected countries
        if (!empty($this->filter->getSelectedCountry())) {
            $builder = new WithdrawMinimumTargeted();
            $query = new \Hlis\SlotsMateModels\Queries\Casinos\CasinoList\TargetedWithdrawMinimums($ids, $this->filter->getSelectedCountry());
            $resultSet = \SQL($query->getQuery(), $query->getParameters());
            while ($row = $resultSet->toRow()) {
                $this->entities[$row["casino_id"]]->withdrawMinimumTargeted[] = $builder->build($row);
            }
        }
    }

    protected function appendWithdrawTimeframes(array $casinoIDs): void
    {
        if (!empty($this->filter->getIsInstantWithdrawal())) {
            $builder = new GlobalWithdrawTimeframeBuilder();
            $allowedBankingMethodTypes = [];
            if (!empty($this->filter->getWithdrawalTimeframeBankingMethodTypes())) {
                $allowedBankingMethodTypes = $this->filter->getWithdrawalTimeframeBankingMethodTypes();
            }
            $query = new WithdrawTimeframesQuery($casinoIDs, $allowedBankingMethodTypes);
            $resultSet = \SQL($query->getQuery(), $query->getParameters());
            while ($row = $resultSet->toRow()) {
                $this->entities[$row["casino_id"]]->withdrawTimeframes[] = $builder->build($row);
            }
        }
    }
}