<?php
namespace Hlis\SlotsMateModels\Entities\Casino;

use Hlis\GlobalModels\Entities\Country;
use Hlis\GlobalModels\Entities\Currency;

class DepositMinimumTargeted extends \Entity
{
    public ?float $value = null;
    public ?Currency $currency = null;
    public ?Country $country = null;
}
