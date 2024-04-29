<?php

namespace Hlis\SlotsMateModels\Entities;

use Hlis\SlotsMateModels\Entities\Feedback\Comment;

class Feedback
{
    public int $id;
    public ?int $entityId = null;

    public string $datetime = '';
    public ?int $helpful = 0;
    public ?User $user = null;
    public ?int $rating = null;
    public ?Comment $comment = null;

}