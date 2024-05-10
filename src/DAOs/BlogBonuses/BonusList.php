<?php

namespace Hlis\SlotsMateModels\DAOs\BlogBonuses;

use Hlis\GlobalModels\Builders\Game\Basic as GameBuilder;
use Hlis\GlobalModels\DAOs\BlogBonuses\BonusList as GlobalBonusList;
use Hlis\SlotsMateModels\Queries\BlogBonuses\BonusList\Games as GamesQuery;
use Hlis\SlotsMateModels\Builders\BlogBonuses\Basic as BonusBuilder;
use Hlis\SlotsMateModels\Queries\BlogBonuses\BonusListItems as BonusListQuery;

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

    protected function appendGames(array $ids): void
    {
        $builder = new GameBuilder();
        $query = new GamesQuery($ids);
        $resultSet = \SQL($query->getQuery(), $query->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entities[$row["bonus_id"]]->games[] = $builder->build($row);
        }
    }
}