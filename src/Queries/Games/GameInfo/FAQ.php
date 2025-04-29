<?php
namespace Hlis\SlotsMateModels\Queries\Games\GameInfo;

use Hlis\GlobalModels\Filters\Filter as Filter;
use Hlis\GlobalModels\SchemaDetector;
use Hlis\GlobalModels\Queries\Query;

class FAQ extends Query
{
    protected Filter $filter;

    public function __construct(Filter $filter)
    {
        $this->filter = $filter;
        $this->query = new \Lucinda\Query\Select("game_faq_game__answers", "t1");

        $this->setFields();
        $this->setJoins();
        $this->setWhere();
        $this->setOrderBy();
    }

    protected function setFields(): void
    {
        $fields = $this->query->fields();
        $fields->add("t3.value", "question");
        $fields->add("t4.id", "question_type_id");
        $fields->add("t4.type", "question_type_name");
        $fields->add("t2.value", "answer");
    }

    protected function setJoins(): void
    {
        $this->query->joinInner('game_faq_answers', "t2")->on(["t1.answer_id" => "t2.id"]);
        $this->query->joinInner('game_faq_questions', "t3")->on(["t2.question_id" => "t3.id"]);
        $this->query->joinInner('game_faq_types', "t4")->on(["t3.type_id" => "t4.id"]);
    }

    protected function setWhere(): void
    {
        $this->query->where()->setIn("t1.game_id", $this->filter->getId());
    }

    protected function setOrderBy(): void
    {
        $this->query->orderBy()->add("t3.id");
    }
}
