<?php

namespace Hlis\SlotsMateModels\Entities;

use Hlis\SlotsMateModels\Entities\Feedback\Comment;
use Hlis\GlobalModels\Entities\Country;

class Feedback extends \Entity
{
    public int $id;
    public ?int $entityId = null;

    public string $datetime = '';
    public ?int $helpful = 0;
    public ?User $user = null;
    public ?int $rating = null;
    public ?Country $country = null;
    public ?Comment $comment = null;

}