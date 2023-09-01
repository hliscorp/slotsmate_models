<?php

namespace Hlis\SlotsMateModels\Filters;

class LearnArticleFilter extends \Hlis\GlobalModels\Filters\Filter
{

    protected ?string $author_ids = null;
    protected ?int $locale_id = null;
    protected ?string $name = null;
    protected ?bool $is_deleted = 0;

    public function setName(string $value): void
    {
        $this->name = $value;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setAuthorIDs(string $values): void
    {
        $this->author_ids = $values;
    }

    public function getAuthorIDs(): ?string
    {
        return $this->author_ids;
    }

    public function setLocaleID(int $value): void
    {
        $this->locale_id = $value;
    }

    public function getLocaleID(): ?int
    {
        return $this->locale_id;
    }

    public function setArticleStatus(bool $value): void
    {
        $this->is_deleted = $value;
    }

    public function getArticleStatus(): ?bool
    {
        return $this->is_deleted;
    }

}
