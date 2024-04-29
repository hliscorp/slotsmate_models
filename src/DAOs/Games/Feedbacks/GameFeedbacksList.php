<?php

namespace Hlis\SlotsMateModels\DAOs\Games\Feedbacks;

use Hlis\SlotsMateModels\Builders\Game\GameFeedback as GameFeedbacksListBuilder;
use Hlis\SlotsMateModels\Queries\Feedbacks\GameFeedbacksList as GameFeedbacksListQuery;
use Hlis\GlobalModels\DAOs\AbstractEntityList;

class GameFeedbacksList extends AbstractEntityList
{

    protected function createTrunks(): void
    {
        $querier = new GameFeedbacksListQuery($this->filter, $this->orderByAlias, $this->limit, $this->offset);
        $builder = $this->getBuilder();
        $resultSet = SQL($querier->getQuery(), $querier->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entities[$row["id"]] = $builder->build($row);
        }
    }

    protected function getBuilder(): GameFeedbacksListBuilder
    {
        return new GameFeedbacksListBuilder();
    }


    protected function appendBranches(array $ids): void
    {
    }
}