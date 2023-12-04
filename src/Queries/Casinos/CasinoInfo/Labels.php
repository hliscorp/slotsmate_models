<?php

namespace Hlis\SlotsMateModels\Queries\Casinos\CasinoInfo;

use Hlis\GlobalModels\Queries\Casinos\CasinoInfo\BasicCasinoDetail;
use Hlis\GlobalModels\Queries\Casinos\CasinoInfo\Labels as GlobalLabels;
use Lucinda\Query\Clause\Fields;

class Labels extends GlobalLabels
{

    protected function setFields(Fields $fields): void
    {
        BasicCasinoDetail::setFields($fields);

        $fields->add("''", "label_code");
    }
}