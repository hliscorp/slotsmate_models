<?php

use Hlis\GlobalModels\Filters\Filter;

class AuthorFilter extends Filter
{

    protected ?int $id = null;
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
        $this->id = $value;
        return $this;
    }

    public function getAuthorID(): ?int
    {
        return $this->id;
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
