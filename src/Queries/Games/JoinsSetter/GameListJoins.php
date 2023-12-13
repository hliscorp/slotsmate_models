<?php

namespace Hlis\SlotsMateModels\Queries\Games\JoinsSetter;

use Hlis\GlobalModels\Queries\Games\JoinsSetter\GameListJoins as GameListJoinsGlobal;
use Hlis\SlotsMateModels\Enums\GameSortCriteria;

class GameListJoins extends GameListJoinsGlobal
{
    protected function appendJoins(): void
    {
        parent::appendJoins();

        if ($this->filter->getMinScore() || $this->filter->getRatings() ||
            $this->filter->getSort() == GameSortCriteria::BEST || $this->filter->getSort() == GameSortCriteria::MOST_PLAYED
        ) {
            $this->query->joinLeft("games__votes", "gv")->on(["t1.id"=>"gv.game_id"]);
        }

        if (!empty($this->filter->getThemes())) {
            $this->query->joinLeft("games__themes", "themes")->on(["t1.id" => "themes.game_id"]);
            $this->groupBy = true;
        }

        if ($this->filter->getPageEntity() == 'Best') {
            $this->query->joinLeft("games__votes_statistics", "gvs")->on(["t1.id"=>"gvs.game_id"]);
            $this->groupBy = true;
        }

        if (empty($this->filter->getFeature()) && !empty($this->filter->getSectionType()) || !empty($this->filter->getFeatures()) || !empty($this->filter->getSlotTypes())) {
            $this->query->joinInner("games__features", "gff")
                ->on(["t1.id" => "gff.game_id"]);
            $this->groupBy = true;
        }
    }
}