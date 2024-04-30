<?php

namespace Hlis\SlotsMateModels\Entities\Feedback;

class Comment
{
    public ?string $body = null;
    public ?string $title = null;
    public ?int $languageId = null;
    public ?bool $isOriginal = null;
    public ?string $originalLanguageName = null;
}