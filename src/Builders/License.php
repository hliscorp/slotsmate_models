<?php

namespace Hlis\SlotsMateModels\Builders;

use Hlis\GlobalModels\Builders\License as DefaultLicense;

class License extends DefaultLicense
{
    public function build(array $row): \Entity
    {
        $license = parent::build($row);

        $license->description = $row['location'];
        return $license;
    }
}