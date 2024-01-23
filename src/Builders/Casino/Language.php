<?php

namespace Hlis\SlotsMateModels\Builders\Casino;

use Hlis\GlobalModels\Builders\Builder;
use Hlis\SlotsMateModels\Entities\Casino\Language as LanguageEntity;

class Language implements Builder
{
    public function build(array $row): \Entity
    {
        $language = new LanguageEntity();
        $language->id = $row["id"];
        $language->name = $row["name"];
        $language->code = $row["code"];
        return $language;
    }
}