<?php

use Hlis\GlobalModels\Filters\Filter;
use Hlis\SlotsMateModels\Enums\AuthorType;

class AuthorFilter extends Filter
{

    protected int $id;
    protected string $name;
    protected AuthorType $authorType;

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

    public function getAuthorType(): ?AuthorType
    {
        return $this->authorType;
    }

    public function setAuthorType(AuthorType $value): self
    {
        $this->authorType = $value;
        return $this;
    }

}
