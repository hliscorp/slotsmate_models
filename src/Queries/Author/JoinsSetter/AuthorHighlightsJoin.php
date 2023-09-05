<?php

namespace Hlis\SlotsMateModels\Queries\Author\JoinsSetter;

use Hlis\SlotsMateModels\Filters\AuthorFilter;
use Hlis\GlobalModels\Filters\Filter;
use Hlis\GlobalModels\Queries\AbstractJoins;
use Lucinda\Query\Select;
use Hlis\GlobalModels\SchemaDetector;

class AuthorHighlightsJoin extends AbstractJoins
{

    public function __construct(AuthorFilter $filter, Select $query)
    {
        parent::__construct($filter, $query);
    } 
    
    public function appendJoins(): void
    { 
        $locale_id = $this->filter->getLocaleID() ?? "0";
        $this->query->joinLeft(SchemaDetector::getInstance()->getAdminSchema().".highlights__writers", "t6")->on(["t1.id"=>"t6.author_id", "t6.locale_id" => $locale_id]);
    }

    protected function getLinkingColumnName(): string
    {
        return "author_id";
    }

}