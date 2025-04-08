<?php
namespace Hlis\SlotsMateModels\Builders\Casino;

use Hlis\SlotsMateModels\Entities\Casino\DepositMinimumTargeted as DepositMinimumTargetedEntity;
use Hlis\GlobalModels\Builders\ExtendableBuilder;
use Hlis\GlobalModels\Entities\Country;
use Hlis\GlobalModels\Entities\Currency;

class DepositMinimumTargeted extends ExtendableBuilder
{
    public function build(array $row): \Entity
    {
        $deposit = $this->getEntity();
        $deposit->value = $row['value'];
        if ($row['currency_id']) {
            $currency = new Currency();
            $currency->id = $row['currency_id'];
            $currency->code = $row['currency_code'];
            $currency->symbol = $row['currency_symbol'];
            $deposit->currency = $currency;
        }
        if ($row['country_id']) {
            $country = new Country();
            $country->id = $row['country_id'];
            $country->name = $row['country_name'];
            $country->code = $row['country_code'];
            $deposit->country = $country;
        }

        return $deposit;
    }

    protected function getEntity(): \Entity
    {
        return new DepositMinimumTargetedEntity();
    }
}