<?php
namespace Hlis\SlotsMateModels\Middleware\IdResolvers;

use Hlis\GlobalModels\Middleware\IdResolver;

class Theme extends IdResolver
{
    protected function getTableName(): string
    {
        return "themes";
    }
}