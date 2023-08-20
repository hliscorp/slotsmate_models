<?php

namespace Hlis\SlotsMateModels\Entities;

class Author extends \Entity
{

    public ?int $id;
    public ?string $name;
    public ?string $tagline; // role
    public $expertise;
    public $highlights; //short_bio
    public $full_bio;
    public $date_joined;
    public $avatar;
    public $socials;

}