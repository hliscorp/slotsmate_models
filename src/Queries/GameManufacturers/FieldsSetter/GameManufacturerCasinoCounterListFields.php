<?php

namespace Hlis\SlotsMateModels\Queries\GameManufacturers\FieldsSetter;
use Hlis\GlobalModels\Queries\AbstractFields;
use Lucinda\Query\Clause\Fields;
class GameManufacturerCasinoCounterListFields extends AbstractFields
{
    public function appendFields(Fields $fields): void
    {
        $fields->add("t1.id")
            ->add("t1.name", 'unit')
            ->add("count(DISTINCT t3.id)",'nr');
    }
}