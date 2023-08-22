<?php

namespace Hlis\SlotsMateModels\Entities\Author;

class SocialNetwork extends \Entity
{

    public ?int $id;
    public ?string $link;
    public ?string $name;
//    public ?int $author_id;
//    public ?int $social_network_id;
    public ?int $priority;

}