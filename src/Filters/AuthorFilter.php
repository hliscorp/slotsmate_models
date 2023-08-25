<?php

namespace Hlis\SlotsMateModels\Filters;

class AuthorFilter extends \Hlis\GlobalModels\Filters\Filter
{

    protected ?int $author_id = null;
    protected ?int $locale_id = null;
    protected ?string $name = null;
    protected ?int $type = null;

    public function setName(string $value): void
    {
        $this->name = $value;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setAuthorID(int $value): void
    {
        $this->author_id = $value;
    }

    public function getAuthorID(): ?int
    {
        return $this->author_id;
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

}
