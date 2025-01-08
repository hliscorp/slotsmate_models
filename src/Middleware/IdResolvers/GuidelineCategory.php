<?php
namespace Hlis\SlotsMateModels\Middleware\IdResolvers;

use Hlis\GlobalModels\Middleware\IdResolver;

class GuidelineCategory extends IdResolver
{
    protected function getTableName(): string
    {
        return "guideline_categories";
    }
}
