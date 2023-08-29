<?php

namespace Hlis\SlotsMateModels\Filters;

class AuthorFilter extends \Hlis\GlobalModels\Filters\Filter
{

    protected ?array $author_ids = null;
    protected ?int $locale_id = null;
    protected ?string $name = null;
    protected ?int $type = null;
    protected ?bool $is_disabled = 0;

    public function setName(string $value): void
    {
        $this->name = $value;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setAuthorIDs(array $values): void
    {
        $this->author_ids = $values;
    }

    public function getAuthorIDs(): ?array
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

    public function setAuthorType(int $value): void
    {
        $this->type = $value;
    }

    public function getAuthorType(): ?int
    {
        return $this->type;
    }


    public function setDisabledStatus(bool $value): void
    {
        $this->is_disabled = $value;
    }

    public function getDisabledStatus(): ?bool
    {
        return $this->is_disabled;
    }

}
