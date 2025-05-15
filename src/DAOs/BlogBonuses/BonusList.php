<?php

namespace Hlis\SlotsMateModels\DAOs\BlogBonuses;

use Hlis\GlobalModels\Builders\Game\Basic as GameBuilder;
use Hlis\GlobalModels\DAOs\BlogBonuses\BonusList as GlobalBonusList;
use Hlis\GlobalModels\Builders\Currency as CurrencyBuilder;
use Hlis\SlotsMateModels\DAOs\BlogBonuses\BonusList\Casinos as CasinosDAO;
use Hlis\SlotsMateModels\Queries\BlogBonuses\BonusList\Games as GamesQuery;
use Hlis\SlotsMateModels\Builders\BlogBonuses\Basic as BonusBuilder;
use Hlis\SlotsMateModels\Queries\BlogBonuses\BonusListItems as BonusListQuery;
use Hlis\SlotsMateModels\Queries\BlogBonuses\BonusList\Currencies as CurrenciesQuery;

class BonusList extends GlobalBonusList
{
    protected function createTrunks(): void
    {
        $builder = new BonusBuilder();
        $querier = new BonusListQuery($this->filter, $this->orderByAlias, $this->limit, $this->offset);
        $resultSet = \SQL($querier->getQuery(), $querier->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entities[$row["id"]] = $builder->build($row);
        }
    }

    protected function appendBranches(array $ids): void
    {
        parent::appendBranches($ids);
        $this->appendCurrencies($ids);
    }

    protected function appendCasinos(array $ids): void
    {
        $dao = new CasinosDAO($ids, $this->filter->getCasinos());
        $list = $dao->getList();
        foreach ($list as $bonusID=>$casinos) {
            $this->entities[$bonusID]->casinos = $casinos;
        }
    }

    protected function appendGames(array $ids): void
    {
        $builder = new GameBuilder();
        $query = new GamesQuery($ids);
        $resultSet = \SQL($query->getQuery(), $query->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entities[$row["bonus_id"]]->games[] = $builder->build($row);
        }
    }

    protected function appendCurrencies(array $ids): void
    {
        $builder = new CurrencyBuilder();
        $query = new CurrenciesQuery($ids);
        $resultSet = \SQL($query->getQuery(), $query->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entities[$row["bonus_id"]]->currencies[] = $builder->build($row);
        }
    }
}