<?php

namespace Hlis\SlotsMateModels\Queries\Games\JoinsSetter;

use Hlis\GlobalModels\Queries\Games\JoinsSetter\GameInfoJoins as GlobalJoins;

class GameInfoJoins extends GlobalJoins
{
    protected function appendJoins(): void
    {
        parent::appendJoins();

        $this->query->joinLeft("games__themes","gmt")->on(["t1.id"=>"gmt.game_id"]);
        $this->query->joinLeft("themes","themes")->on(["gmt.theme_id"=>"themes.id"]);

        $this->query->joinLeft("game_play__matches", "gpm")->on(["t1.id"=>"gpm.game_id"]);

        $this->query->joinLeft("game_play__patterns","gpp")->on()
            ->set("gpp.id", "gpm.pattern_id")
            ->setIn("gpp.isMobile", ($this->filter->getIsMobile()?[0,2]:[1,2]));

        $this->query->joinLeft("games__features","gsf")->on(["t1.id"=>"gsf.game_id"]);

        $this->query->joinLeft("game_features", "gf")->on(["gsf.feature_id"=>"gf.id"]);

        $this->query->joinLeft("games__paytables", "gp")->on(["t1.id"=>"gp.game_id"]);

        $this->query->joinLeft("locale__game_manufacturers", "lgm")->on([
            "lgm.game_manufacturers_id" => "t1.game_manufacturer_id",
            "lgm.locale_id" => $this->filter->getLocale()
        ]);
    }
}