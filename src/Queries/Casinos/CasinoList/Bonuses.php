<?php
namespace Hlis\SlotsMateModels\Queries\Casinos\CasinoList;

use Lucinda\Query\Clause\Fields;
use Hlis\SlotsMateModels\Enums\CasinoSortCriteria;
use Lucinda\Query\Operator\OrderBy;

class Bonuses extends \Hlis\GlobalModels\Queries\Casinos\CasinoList\Bonuses
{
    protected string $orderByAlias;

    public function __construct (array $casinoIDs, string $orderByAlias)
    {
        parent::__construct($casinoIDs);
        $this->orderByAlias = $orderByAlias;
        $this->setOrder();
    }

    protected function setFields(Fields $fields): void
    {
        parent::setFields($fields);

        $fields->add("t1.client_id");
        $fields->add("t1.games");
        $fields->add("t1.wagering");
        $fields->add("t1.deposit_minimum");
    }

    protected function setOrder(): void
    {
        switch ($this->orderByAlias) {
            case CasinoSortCriteria::AMOUNT_FS_PRIORITY:
                $this->query->orderBy()
                    ->add("amount_fs")
                    ->add("t1.id");
                break;
            default:
                $this->query->orderBy()->add("t1.is_exclusive");
        }
    }
}