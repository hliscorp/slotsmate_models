<?php

namespace Hlis\SlotsMateModels\Queries\Games\JoinsSetter;

use Hlis\GlobalModels\Queries\Games\JoinsSetter\GameListJoins as GameListJoinsGlobal;

class GameListSearchJoins extends GameListJoinsGlobal
{
    protected function appendJoins(): void
    {
        $this->query->joinInner('game_manufacturers', 'gm')->on(['t1.game_manufacturer_id' => 'gm.id']);
        $this->query->joinInner("locale__game_manufacturers", "lgm")->on([
            "lgm.game_manufacturers_id" => "gm.id",
            "lgm.locale_id" => $this->filter->getLocale()
        ]);

        $this->query->joinInner("game_types", "t3")->on(["t1.game_type_id"=>"t3.id"]);

        $this->query->joinInner("games__features", "t8")->on(["t1.id" => "t8.game_id", "t8.feature_id" => ($this->filter->getIsMobile() ? 7 : 8)]);
        $this->query->joinInner("game_features")->on(["game_features.id" => "t8.feature_id"]);

        $this->query->joinInner("game_play__matches", "t6")->on(["t1.id" => "t6.game_id"]);
        $this->query->joinInner("game_play__patterns", "t7")->on(["t7.id" => "t6.pattern_id"])->set("t7.type_id", 4, \Lucinda\Query\Operator\Comparison::DIFFERS)->setIn("t7.isMobile", ($this->filter->getIsMobile() ? [1, 2] : [0, 2]))->set("t7.type_id", 4, \Lucinda\Query\Operator\Comparison::DIFFERS);
    }
}