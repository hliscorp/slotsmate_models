<?php

namespace Hlis\SlotsMateModels\Entities\Author;

use Hlis\GlobalModels\Entities\SocialNetwork as SocialNetworkBaseEntity;

class SocialNetwork extends SocialNetworkBaseEntity
{
    public ?int $priority = null;
    public ?string $link = null;
}