<?php

namespace Hlis\SlotsMateModels\Builders\Casino\Info;

use Hlis\GlobalModels\Builders\Casino\Info\Basic as DefaultBasic;
use Hlis\SlotsMateModels\Entities\Casino as CasinoEntity;
use Hlis\GlobalModels\Entities\Casino\Features;

class Basic extends DefaultBasic
{
    public function build(array $row): \Entity
    {
        $casino = parent::build($row);

        $casino->dateEstablished = $row["date_established"];
        $casino->features = $this->compileCasinoFeatures($row);
        return $casino;
    }

    protected function compileCasinoFeatures(array $row): Features
    {
        $features = new Features();
        $features->depositMinimum = $row["deposit_minimum"];
        $features->withdrawMinimum = $row["withdraw_minimum"];
        return $features;
    }

    protected function getEntity(): \Entity
    {
        return new CasinoEntity();
    }
}