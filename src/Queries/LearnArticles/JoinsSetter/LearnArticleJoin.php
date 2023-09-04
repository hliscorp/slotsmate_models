<?php

namespace Hlis\SlotsMateModels\Queries\LearnArticles\JoinsSetter;

use Hlis\SlotsMateModels\Filters\LearnArticleFilter;
use Hlis\GlobalModels\Filters\Filter;
use Hlis\GlobalModels\Queries\AbstractJoins;
use Lucinda\Query\Select;
use Hlis\GlobalModels\SchemaDetector;

class LearnArticleJoin extends AbstractJoins
{

    public function __construct(LearnArticleFilter $filter, Select $query)
    {
        parent::__construct($filter, $query);
    } 
    
    public function appendJoins(): void
    { 
        $this->query->joinLeft(SchemaDetector::getInstance()->getAdminSchema().".writers", "t2")->on(["t1.writer_id"=>"t2.id"]);
    }

    protected function getLinkingColumnName(): string
    {
        return "writer_id";
    }

}