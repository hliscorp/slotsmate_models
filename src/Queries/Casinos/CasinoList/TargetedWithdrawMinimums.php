<?php
namespace Hlis\SlotsMateModels\Queries\Casinos\CasinoList;

class TargetedWithdrawMinimums extends TargetedDepositMinimums
{
    protected string $baseTable = "casinos__minimum_withdrawal";
}
