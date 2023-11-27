<?php

namespace Hlis\SlotsMateModels\Queries\Casinos\CasinoInfo;

use Hlis\GlobalModels\Queries\Casinos\CasinoInfo\GameManufacturers as DefaultGameManufacturers;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Clause\Fields;
use Lucinda\Query\Select;

class GameManufacturers extends DefaultGameManufacturers
{
    protected function setFields(Fields $fields): void
    {
        $fields->add("t1.is_primary");
        $fields->add("t1.game_manufacturer_id","id");
        $fields->add("t2.name", "name");
    }
    
    protected function setJoins(): void
    {
        parent::setJoins();

        if($this->filter->getLocaleCountry()) {
            $this->query->joinInner('game_manufacturers__countries_allowed', 't3')->on([
                "t1.game_manufacturer_id"=>"t3.game_manufacturer_id",
                "t3.country_id"=>$this->filter->getLocaleCountry()
            ]);
        }
    }

    protected function setWhere(Condition $condition): void
    {
        parent::setWhere($condition);

        $condition->set('t2.is_open', 1);
    }
}
