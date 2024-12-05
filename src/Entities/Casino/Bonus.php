<?php
namespace Hlis\SlotsMateModels\Entities\Casino;

use Hlis\GlobalModels\Entities\Casino\Bonus as CasinoBonusEntity;

class Bonus extends CasinoBonusEntity
{
    public ?int $id = null;
    public ?int $clientId = null;
}