<?php

namespace Hlis\SlotsMateModels\Entities\Author;

class Author extends \Entity
{

    public ?int $id = null;
    public ?string $name = null;
    public ?string $date_joined = null;
    public ?string $expertise = null;
    public ?string $highlights = null; // prev short_bio
    public ?string $full_bio = null;
    public ?string $tagline = null; // prev role (string) but now it is based on locale_id
    public ?array $social_networks = [];

}