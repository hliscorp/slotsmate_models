<?php
namespace Hlis\SlotsMateModels\Queries\Casinos;

use Hlis\GlobalModels\Filters\Filter;
use Hlis\GlobalModels\Queries\Casinos\JoinsSetter\CasinoListJoins as AbstractCasinoListJoins;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Select;
use Hlis\SlotsMateModels\Enums\CasinoSortCriteria;

class CasinoListJoins extends AbstractCasinoListJoins
{
    protected string $orderByAlias;

    public function __construct(Filter $filter, Select $query, string $orderByAlias = "")
    {
        $this->orderByAlias = $orderByAlias;
        parent::__construct($filter, $query);
    }

    protected function getLinkingColumnName(): string
    {
        return "casino_id";
    }

    public function appendJoins(): void
    {
        parent::appendJoins();
        $this->appendLiveDealerJoin();
        $this->appendPopularGameTypesJoin();
        $this->appendCasinoLabelJoin();
        $this->appendAllGameTypesJoin();
        $this->setSoftwareNameJoin();
        $this->appendBankingMethodsJoin();
        $this->appendCasinoLicenseJoin();
        $this->setCasinosGeoPriorityJoin();
        $this->setMinimumDepositJoin();
        $this->setWithdrawTimeframesJoin();
        $this->setCustomCategoryJoin();
    }

    protected function setCustomCategoryJoin(): void
    {
        if ($this->filter->getCustomCasinoCategory()) {
            $this->query->joinInner("casinos__custom_lists_items", "casinos_cus_cat")->on(["t1.id" => "casinos_cus_cat.casino_id"])
                ->set("casinos_cus_cat.category_id", $this->filter->getCustomCasinoCategory());
        }
    }

    protected function setSoftwareNameJoin(): void
    {
        if ($this->filter->getAdditionalSoftware()) {
            $this->query->joinInner("casinos__game_manufacturers", "cgm")->on(["t1.id" => "cgm.casino_id"])->set("cgm.game_manufacturer_id", $this->filter->getAdditionalSoftware());
        }
    }


    protected function appendLiveDealerJoin(): void
    {
        if ($this->filter->getIsLiveDealer() && !$this->filter->getGameTypes()) {
            $this->query->joinInner("casinos__game_types", "t7")->on(["t7.casino_id" => "t1.id"]);
            $this->groupBy = true;
        }
    }

    protected function appendCasinoLabelJoin(): void
    {
        if ($this->filter->getLabels()) {
            $labels = implode(',', $this->filter->getLabels());

            $this->query->joinInner("casinos__labels", "t5")->on(["t1.id" => "t5.casino_id", "t5.label_id" => "(" . $labels . ")"]);
        }
    }

    protected function setBonusesJoins(): void
    {
        $aliasIndex = 22;
        $filter = $this->filter->getBonus();
        if ($filter !== null) {
            $alias1 = "t".$aliasIndex;
            $alias2 = "t".($aliasIndex+1);
            $onClause = $this->query->joinInner("casinos__bonuses", $alias1)->on();
            $onClause->set("t1.id", $alias1.".casino_id");
            if ($ids = $filter->getType()) {
                $onClause->setIn($alias1.".bonus_type_id", $ids);
            }
            if ($filter->getIsExclusive()) {
                $onClause->set($alias1.".is_exclusive", 1);
            }
            if ($country = $filter->getSelectedCountry()) {
                $this->addCasinoBonusSelectedCountryJoin($country, $alias1, $alias2);
            }
            if ($country = $filter->getTargetCountry()) {
                $this->addCasinoBonusTargetCountryJoin($country, $alias1, 'cbtargets'.$alias2);
            }

            $this->groupBy = true;
        }
    }

    protected function appendBankingMethodsJoin(): void
    {
        if ($bankingMethod = $this->filter->getBankingMethods()) {
            $this->groupBy = true;
            $bankingMethodID = key($bankingMethod->getId());

            $this->query->joinLeft("casinos__deposit_methods", "tbm13")->on([
                "t1.id"=>"tbm13.casino_id",
                "tbm13.banking_method_id"=>$bankingMethodID
            ]);
            $this->query->joinLeft("casinos__withdraw_methods", "tbm16")->on([
                "t1.id"=>"tbm16.casino_id",
                "tbm16.banking_method_id"=>$bankingMethodID
            ]);
        }
    }

    protected function appendAllGameTypesJoin(): void
    {
        //TODO: investigate and refactor that shit
        if ($this->filter->getGameTypes() || ($this->filter->getIsAllGameTypes() && $this->filter->getPageType() !== 'no-deposit-slots')) {
            $this->query->joinLeft("casinos__bonuses", "cb_fb")->on(["cb_fb.casino_id" => "t1.id"])->setIn("cb_fb.bonus_type_id", [3,4,5]);
            $this->query->joinLeft("casinos__bonuses", "cb_fdb")->on(["cb_fdb.casino_id" => "t1.id", "cb_fdb.bonus_type_id" => "2"]);
            $this->query->joinLeft("casinos__bonuses", "cb_dd")->on(["cb_dd.casino_id" => "t1.id"])->setIn("cb_dd.bonus_type_id", [3,4,5,6,11]);
            $this->groupBy = true;
        }
    }

    protected function appendPopularGameTypesJoin(): void
    {
        if ($this->filter->getIsPopularGameTypes()) {
            if (!$this->filter->getIsLiveDealer() && !$this->filter->getGameTypes()) {
                $this->query->joinInner("casinos__game_types", "t7")->on(["t7.casino_id" => "t1.id"]);
                $this->groupBy = true;
            }
            $this->query->joinInner("game_types", "t26")->on(["t26.id" => "t7.game_type_id"]);
        }
    }

    protected function appendCasinoLicenseJoin(): void
    {
        if ($this->filter->getSelectedCountry() && in_array($this->filter->getSelectedCountry(),[1, 53])) {
            $this->query->joinInner('casinos__licenses', 'cl')->on(['t1.id' => 'cl.casino_id']);
            $this->query->joinInner('licenses', 'lcns')->on(['cl.license_id' => 'lcns.id']);
            $this->query->joinInner('jurisdictions', 'j')->on(['j.country_id' => $this->filter->getSelectedCountry()]);
            $this->query->joinInner('jurisdictions__licenses', 'j_l')->on(['j_l.license_id' => 'lcns.id', 'j_l.jurisdiction_id' => 'j.id']);
        }
    }

    protected function addCasinoBonusSelectedCountryJoin(int $country, string $alias1, string $alias2): void
    {
        $subSelect = new Select("casinos__bonuses", "cb1");
        $subSelect->fields()->add("cb1.id");
        $subSelect->joinLeft("casinos__bonuses_countries", "cbc1")->on(["cb1.id"=>"cbc1.casino_bonus_id"]);
        $subSelect->where()->setIsNull("cbc1.id");

        $subSelect2 = new Select("casinos__bonuses", "cb2");
        $subSelect2->fields()->add("cb2.id");
        $subSelect2->joinInner("casinos__bonuses_countries", "cbc2")
            ->on(["cb2.id"=>"cbc2.casino_bonus_id", "cbc2.country_id"=>$country, "cbc2.is_allowed"=>1]);

        $subSelect3 = new Select("casinos__bonuses", "cb3");
        $subSelect3->fields()->add("cb3.id");
        $subSelect3->joinLeft("casinos__bonuses_countries", "cbc3")
            ->on(["cb3.id"=>"cbc3.casino_bonus_id", "cbc3.country_id"=>$country, "cbc3.is_allowed"=>0]);
        $subSelect3Where = $subSelect3->where();
        $subSelect3Where->setIsNull("cbc3.id");

        $subSelect3SubSelect = new Select("casinos__bonuses_countries");
        $subSelect3SubSelect->fields()->add("casino_bonus_id");
        $subSelect3SubSelect->where()->set("is_allowed", 0);
        $subSelect3Where->setIn("cb3.id", $subSelect3SubSelect);

        $this->query->joinInner(
            "((" . $subSelect->toString() . ") UNION (" . $subSelect2->toString() . ") UNION (" . $subSelect3->toString() . "))",
            $alias2)->on(["$alias1.id"=>"$alias2.id"]);
    }

    protected function addCasinoBonusTargetCountryJoin(int $country, string $alias1, string $alias2): void
    {
        $subSelect1 = new Select("casinos__bonuses", "cb1");
        $subSelect1->fields()->add("cb1.id")->add(0, "targeted");
        $subSelect1->joinLeft("casinos__bonuses_targets", "cbc1")->on(["cb1.id"=>"cbc1.casino_bonus_id"]);
        $subSelectWhere1 = $subSelect1->where();
        $subSelectWhere1->setIsNull("cbc1.casino_bonus_id");

        $subSelect2 = new Select("casinos__bonuses", "cb2");
        $subSelect2->fields()->add("cb2.id")->add(1, "targeted");
        $subSelect2->joinInner("casinos__bonuses_targets", "cbc2")
            ->on(["cb2.id"=>"cbc2.casino_bonus_id", "cbc2.country_id"=>$country]);

        $this->query->joinInner(
            "((" . $subSelect1->toString() . ") UNION (" . $subSelect2->toString() . "))",
            $alias2)->on(["$alias1.id"=>"$alias2.id"]);
    }

    protected function setCasinosGeoPriorityJoin(): void
    {
        $countryId = $this->filter->getSelectedCountry();
        if (!in_array($this->orderByAlias, [
                CasinoSortCriteria::GEO_PRIORITY,
                CasinoSortCriteria::MINIMUM_DEPOSIT_GEO_PRIORITY,
                CasinoSortCriteria::AMOUNT_FS_GEO_PRIORITY,
                CasinoSortCriteria::WITHDRAW_TIME_GEO_PRIORITY,
                CasinoSortCriteria::HAS_APP_GEO_PRIORITY,
            ])
            || !$countryId) {
            return;
        }

        $this->query->joinLeft('casinos__priorities', 'cp')->on([
            'cp.casino_id'  => 't1.id',
            'cp.country_id' => $countryId
        ]);

        $this->query->joinLeft('casinos__priorities', 'cp1')->on([
            'cp1.casino_id'  => 't1.id',
            'cp1.country_id' => 0
        ]);
    }

    protected function setMinimumDepositJoin(): void
    {
        if ($this->filter->getDepositRange() && $this->filter->getSelectedCountry() && $this->filter->getCurrencies()) {
            $subSelect = new Select("casinos__minimum_deposit", "md1");
            $subSelect->fields()->add("md1.*");
            $subSelectJoin = $subSelect->joinLeft("casinos__minimum_deposit", "md2")->on(["md1.casino_id"=>"md2.casino_id"]);
            $subSelectJoinGroup = new Condition([], \Lucinda\Query\Operator\Logical::_OR_);
            $subSelectJoinGroupCondition1 = new Condition();
            $subSelectJoinGroupCondition1->setIsNull("md1.currency_id");
            $subSelectJoinGroupCondition1->setIn("md2.currency_id", $this->filter->getCurrencies());
            $subSelectJoinGroupCondition2 = new Condition();
            $subSelectJoinGroupCondition2->setIn("md1.currency_id", $this->filter->getCurrencies(), false);
            $subSelectJoinGroupCondition2->setIsNull("md2.currency_id");
            $subSelectJoinGroup->setGroup($subSelectJoinGroupCondition1);
            $subSelectJoinGroup->setGroup($subSelectJoinGroupCondition2);
            $subSelectJoin->setGroup($subSelectJoinGroup);

            $subSelectWhere = $subSelect->where();
            $subSelectWhere->setIsNull("md2.id");
            $subSelectWhere->setBetween("md1.value", ...$this->filter->getDepositRange());
            $subSelectWhereCondition = new Condition([], \Lucinda\Query\Operator\Logical::_OR_);
            $subSelectWhereCondition->setIsNull("md1.currency_id");
            $subSelectWhereCondition->setIn("md1.currency_id", $this->filter->getCurrencies());
            $subSelectWhere->setGroup($subSelectWhereCondition);
            $this->query->joinInner(
                "(" . $subSelect->toString() . ")",
                "cmd"
            )->on(["t1.id" => "cmd.casino_id"]);
            $join2 = $this->query->joinLeft('casinos__minimum_deposit__countries', 'cmdc')->on();
            $join2->set('cmd.id', 'cmdc.record_id');
            $join2->set('cmdc.country_id', $this->filter->getSelectedCountry());
            $this->groupBy = true;
        }
    }

    protected function setWithdrawTimeframesJoin(): void
    {
        if($this->filter->getIsInstantWithdrawal()) {
            $join = $this->query->joinInner("casinos__withdraw_timeframes", "cwt")->on(["t1.id"=>"cwt.casino_id"]);

            if (!empty($this->filter->getWithdrawalTimeframeBankingMethodTypes())) {
                $join->setIn("cwt.banking_method_type_id", $this->filter->getWithdrawalTimeframeBankingMethodTypes());
            }
            $this->groupBy = true;
        }
    }
}