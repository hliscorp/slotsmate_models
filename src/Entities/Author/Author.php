<?php

namespace Hlis\SlotsMateModels\Entities\Author;

class Author extends \Entity
{

    public ?int $id;
    public ?string $name;
    public ?string $date_joined;
    public ?string $expertise;
    public ?string $highlights; // prev short_bio
    public ?string $full_bio;
    public ?string $tagline; // prev role (string) but now it is based on locale_id
    public ?array $social_networks;
    // public ?array $games;
    // public ?array $articles;

}