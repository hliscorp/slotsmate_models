<?php

namespace Hlis\SlotsMateModels\Queries\Casinos\CasinoInfo;

use Hlis\GlobalModels\Queries\Casinos\CasinoInfo\Certifications as GlobalCertifications;
use Lucinda\Query\Clause\Fields;

class Certifications extends GlobalCertifications
{
    protected function setFields(Fields $fields): void
    {
        parent::setFields($fields);
    }
}