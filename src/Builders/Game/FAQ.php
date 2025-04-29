<?php
namespace Hlis\SlotsMateModels\Builders\Game;

use Hlis\GlobalModels\Builders\Builder as Builder;
use Hlis\SlotsMateModels\Entities\Game\FAQItem as FAQItem;
use Hlis\SlotsMateModels\Entities\Game\FAQType as FAQType;

class FAQ implements Builder
{
    public function build(array $item): FAQItem
    {
        $faqItem = new FAQItem();
        $faqItem->question = $item['question'];
        $faqItem->answer = $item['answer'];

        $faqType = new FAQType();
        $faqType->id = $item['question_type_id'];
        $faqType->name = $item['question_type_name'];
        $faqItem->type = $faqType;

        return $faqItem;
    }
}
