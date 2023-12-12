<?php

namespace Hlis\SlotsMateModels\Filters;

class GameSearch extends Game
{
    private ?string $search = null;

    public function getSearch(): ?string
    {
        return $this->search;
    }

    public function setSearch(string $search): void
    {
        $this->search = $search;
    }
}