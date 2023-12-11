<?php

namespace Hlis\SlotsMateModels\Builders\Casino\Info;

use Hlis\SlotsMateModels\Entities\Casino;
use Hlis\GlobalModels\Builders\Casino\Info\Detailed as GlobalDetailed;
use Hlis\SlotsMateModels\Entities\Casino\Features;

class Detailed extends GlobalDetailed
{
    public function build(array $row): \Entity
    {
        $result = parent::build($row);
        return $result;
    }

    protected function compileCasinoFeatures(array $row): Features
    {
        $features = new Features();
        $features->isLiveChat = $row["is_live_chat"];
        $features->depositMinimum = $row["deposit_minimum"];
        $features->withdrawMinimum = $row["withdraw_minimum"];
        if(isset($row["is_live"])) {
            $features->isLiveDealer = $row["is_live"];
        }
        return $features;
    }

    protected function getEntity(): \Entity
    {
        return new Casino();
    }
}