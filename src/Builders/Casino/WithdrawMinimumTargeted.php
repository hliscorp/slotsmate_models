<?php
namespace Hlis\SlotsMateModels\Builders\Casino;

use Hlis\SlotsMateModels\Entities\Casino\WithdrawMinimumTargeted as WithdrawMinimumTargetedEntity;

class WithdrawMinimumTargeted extends DepositMinimumTargeted
{
    protected function getEntity(): \Entity
    {
        return new WithdrawMinimumTargetedEntity();
    }
}