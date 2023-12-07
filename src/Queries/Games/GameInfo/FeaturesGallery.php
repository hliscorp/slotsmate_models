<?php

namespace Hlis\SlotsMateModels\Queries\Games\GameInfo;

class FeaturesGallery extends \Hlis\GlobalModels\Queries\Games\GameInfo\FeaturesGallery
{
    protected function setFields(): void
    {
        $fields = $this->query->fields();
        $fields->add("t1.game_id");
        $fields->add("t1.feature_id");
        $fields->add("gf.name", "feature_name");
        $fields->add("gfg.is_desktop");
        $fields->add("gfg.caption");
        $fields->add("gfg.gif_id");
        $fields->add("gfg.vimeo_id");
        $fields->add("gfg.logo_id", "file_name");
    }
    protected function setJoins(): void
    {
        $this->query->joinInner("game_features", "gf")->on(["t1.feature_id" => "gf.id"]);
        $this->query->joinInner("games__features_gallery", "gfg")->on(["t1.id" => "gfg.game_feature_id"]);
    }

}