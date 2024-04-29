<?php

namespace Hlis\SlotsMateModels\Filters;

use Hlis\GlobalModels\Filters\Filter;

class Feedback extends Filter
{
    protected ?array $entityIds = null;
    protected ?bool $hasComments = null;
    protected ?string $ip = null;
    protected ?array $statusesIds = null;

    public function addEntityId(int $id): void
    {
        $this->entityIds[] = $id;
    }

    public function getEntityIds(): ?array
    {
        return $this->entityIds;
    }

    public function setEntityIds(?array $entityIds): void
    {
        $this->entityIds = $entityIds;
    }

    public function hasComments(): ?bool
    {
        return $this->hasComments;
    }

    public function setHasComments(?bool $hasComments): void
    {
        $this->hasComments = $hasComments;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(?string $ip): void
    {
        $this->ip = $ip;
    }

    public function addStatusId(int $id): void
    {
        $this->statusesIds[] = $id;
    }

    public function getStatusesIds(): ?array
    {
        return $this->statusesIds;
    }

    public function setStatusesIds(?array $statusesIds): void
    {
        $this->statusesIds = $statusesIds;
    }

}