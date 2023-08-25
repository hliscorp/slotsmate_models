<?php

namespace Hlis\SlotsMateModels\Queries\Author\JoinsSetter;

use Hlis\SlotsMateModels\Filters\AuthorFilter;
use Hlis\GlobalModels\Filters\Filter;
use Hlis\GlobalModels\Queries\AbstractJoins;
use Lucinda\Query\Select;

class AuthorTaglineJoin extends AbstractJoins
{

    public function __construct(AuthorFilter $filter, Select $query)
    {
        parent::__construct($filter, $query);
    } 
    
    public function appendJoins(): void
    { 
        $this->query->joinLeft("tagline__writers", "t4")->on(["t1.id"=>"t4.author_id"]);
    }

    protected function getLinkingColumnName(): string
    {
        return "author_id";
    }

}