<?php

namespace Hlis\SlotsMateModels\Queries\Games\JoinsSetter;

use Hlis\GlobalModels\Queries\Games\JoinsSetter\GameListJoins as GameListJoinsGlobal;
use Hlis\SlotsMateModels\Enums\GameSortCriteria;

class GameListJoins extends GameListJoinsGlobal
{
    protected function appendJoins(): void
    {
        parent::appendJoins();

        $this->query->joinLeft("game_play__matches", "gp_m")->on(["t1.id" => "gp_m.game_id"]);

        if ($this->filter->getMinScore() || $this->filter->getRatings() ||
            $this->filter->getSort() == GameSortCriteria::BEST || $this->filter->getSort() == GameSortCriteria::MOST_PLAYED
        ) {
            $this->query->joinLeft("games__votes", "gv")->on(["t1.id"=>"gv.game_id"]);
        }

        if (!empty($this->filter->getThemes())) {
            $this->query->joinLeft("games__themes", "themes")->on(["t1.id" => "themes.game_id"])->setIn("themes.theme_id", $this->filter->getThemes());
            $this->groupBy = true;
        }

        if (!empty($this->filter->getMainTheme())) {
            $this->query->joinLeft("games__themes", "themes2")->on(["t1.id" => "themes2.game_id"])->setIn("themes2.theme_id", $this->filter->getMainTheme());
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

        if (!empty($this->filter->getMainFeature())) {
            $this->query->joinInner("games__features", "gffMain")
                ->on(["t1.id" => "gffMain.game_id"]);
            $this->groupBy = true;
        }

        $this->query->joinInner("locale__game_manufacturers", "lgm")->on([
            "lgm.game_manufacturers_id" => "gm.id",
            "lgm.locale_id" => $this->filter->getLocale()
        ]);
    }
}