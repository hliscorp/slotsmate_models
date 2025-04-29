<?php

namespace Hlis\SlotsMateModels\Entities\Game;

class FAQItem extends \Entity
{
    public FAQType $type;
    public string $question;
    public string $answer;
}
