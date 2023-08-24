<?php

namespace Hlis\SlotsMateModels\Filters;

class AuthorFilter extends \Hlis\GlobalModels\Filters\Filter
{

    protected ?int $author_id = null;
    protected ?int $locale_id = null;
    protected ?string $name = null;

    public function setName(string $value): self
    {
        $this->name = $value;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setAuthorID(int $value): self
    {
        $this->author_id = $value;
        return $this;
    }

    public function getAuthorID(): ?int
    {
        return $this->author_id;
    }

    public function setLocaleID(int $value): self
    {
        $this->locale_id = $value;
        return $this;
    }

    public function getLocaleID(): ?int
    {
        return $this->locale_id;
    }

}
