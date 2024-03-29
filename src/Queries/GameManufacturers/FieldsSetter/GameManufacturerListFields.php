<?php

namespace Hlis\SlotsMateModels\Queries\GameManufacturers\FieldsSetter;
use Hlis\GlobalModels\Queries\AbstractFields;
use Lucinda\Query\Clause\Fields;

class GameManufacturerListFields extends AbstractFields
{
    public function appendFields(Fields $fields): void
    {
        $fields->add("t1.id")
        ->add("t1.name", 'unit')
        ->add("count(DISTINCT t2.id)",'nr')
        ->add("IF(t14.id IS NOT NULL,1,0) AS softwareLocaleSupported");
    }
}