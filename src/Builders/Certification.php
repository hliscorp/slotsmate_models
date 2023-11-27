<?php

namespace Hlis\SlotsMateModels\Builders;

use Hlis\GlobalModels\Builders\Certification as DefaultCertification;

class Certification extends DefaultCertification
{
    public function build(array $row): \Entity
    {
        $certification = parent::build($row);

        $certification->description = $row['certification_name'];
        return $certification;
    }
}