<?php

namespace Hlis\SlotsMateModels\Queries\Games\ConditionsSetter;

use Hlis\GlobalModels\Queries\Games\ConditionsSetter\GameListConditions as GameListConditionsGlobal;
use Lucinda\Query\Clause\Condition;
use Lucinda\Query\Operator\Comparison;

class GameListConditions extends GameListConditionsGlobal
{
    public function appendConditions(Condition $condition): void
    {
        parent::appendConditions($condition);
        $this->setManufacturerOpenCondition($condition);
        $this->setFeaturesCondition($condition);
        $this->setVolatilityCondition($condition);
        $this->setIsMobileCondition($condition);
        $this->setMinimumDateLaunchedCondition($condition);
        $this->setMinimumScoreCondition($condition);
        $this->setSectionAndGameTypeCondition($condition);
        $this->setPageEntityCondition($condition);
        $this->setUpcomingCondition($condition);
        $this->setExcludeIdsCondition($condition);
        $this->setIsBestCondition($condition);
        $this->setReelsCondition($condition);
        $this->setSlotTypesCondition($condition);
        $this->setThemesCondition($condition);
        $this->setNewAdvancedFilters($condition);
        $this->setRatingsCondition($condition);
        $this->setSearchCondition($condition);
    }

    protected function setSearchCondition(Condition $condition): void
    {
        if ($this->filter->getSearch()) {
            $search = strtolower(str_replace(" ", "%", $this->filter->getSearch()));
            $condition->setLike('t1.name', ':search');
            $this->parameters[':search'] = "%".$search."%";
        }
    }

    protected function setManufacturerOpenCondition(Condition $condition): void
    {
        if ($this->filter->getSectionType() != "closed") {
            $this->buildBooleanCondition($condition, "gm.is_open", true);
        }
    }

    protected function setFeaturesCondition(Condition $condition): void
    {
        if ($features = $this->filter->getFeatures()) {
            $condition->setIn("gff.feature_id", $features);
        }

        if ($mainFeature = $this->filter->getMainFeature()) {
            $condition->setIn("gffMain.feature_id", $mainFeature);
        }
    }

    protected function setVolatilityCondition(Condition $condition): void
    {
        if ($this->filter->getVolatility()) {
            $condition->setIn("t1.game_volatility_id", $this->filter->getVolatility());
        }
    }

    protected function setIsMobileCondition(Condition $condition): void
    {
        if($this->filter->getIsOpen() === false) return;

        if ($this->filter->getIsMobile()) {
            $condition->set("t1.is_mobile", 1);
        } else {
            $condition->set("t1.is_desktop", 1);
        }
    }

    protected function setMinimumDateLaunchedCondition(Condition $condition): void
    {
        if ($this->filter->getMinDate()) {
            $condition->set("t1.date_launched", "'" . $this->filter->getMinDate() . "'", Comparison::GREATER_EQUALS);
        }
    }

    protected function setMinimumScoreCondition(Condition $condition): void
    {
        if ($this->filter->getMinScore()) {
            $condition->set("gv.score", $this->filter->getMinScore(), Comparison::GREATER_EQUALS);
        }
    }

    protected function setSectionAndGameTypeCondition(Condition $condition): void
    {
        $sectionType = $this->filter->getSectionType();
        if($sectionType){
            if($sectionType == 'bonus round'){
                $condition->set("gff.feature_id", '1');
            }else if($sectionType == 'free spins'){
                $condition->set("gff.feature_id", '5');
            }
        }

        $gameType = $this->filter->getGameType();
        $types = [12, 4];

        if(!empty($gameType)) {
            if($gameType == 13){ // 13 - Special
                $types = [7];    // 7  - Other
            } else {
                $types = [$gameType];
            }
        }

        if ($sectionType == 'other') {

            foreach ($types as $type) {
                $condition->set("t1.game_type_id", $type, Comparison::DIFFERS);
            }

        } else {
            if ($sectionType != "closed") {
                $condition->setIn("t1.game_type_id", $types);
            }
        }
    }

    protected function setPageEntityCondition(Condition $condition): void
    {
        $entity = $this->filter->getPageEntity();

        if ($entity == 'penny') {
            $condition->set('t1.min_cs', "0.01");
        } elseif ($entity == 'video') {
            $condition->set('t1.game_type_id', '12');  // not sure if it's need it because above we have types array
        } elseif ($entity == 'slots') {
            $condition->set('t1.game_type_id', '4');
        } elseif ($entity == 'RTP') {
            $condition->set('t1.rtp', 97.5, Comparison::GREATER_EQUALS);
        } elseif (!$this->filter->getUpcoming() && strtolower($entity??' ') == 'new') {
            $condition->set("t1.date_launched", "'" . date("Y-m-d", strtotime("-1 year", time())) . "'", Comparison::GREATER);
            $condition->set("t1.date_launched", "'" . date("Y-m-d") . "'", Comparison::LESSER_EQUALS);
        }
    }

    protected function setUpcomingCondition(Condition $condition): void
    {
        if ($this->filter->getUpcoming()) {
            $condition->set("t1.date_launched", "'" . date("Y-m-d") . "'", Comparison::GREATER);
        } elseif (!$this->filter->getIgnoreDateLaunch() && $this->filter->getPageEntity() != 'Best') {
            $group = new Condition([], \Lucinda\Query\Operator\Logical::_OR_);
            $group->set("t1.date_launched", "'" . date("Y-m-d") . "'", Comparison::LESSER_EQUALS);
            $group->set("t1.date_launched", "", Comparison::IS_NULL);
            $condition->setGroup($group);
        }
    }

    protected function setExcludeIdsCondition(Condition $condition): void
    {
        if ($excludeIds = $this->filter->getExcludeIds()) {
            $condition->setIn("t1.id", $excludeIds, false);
        }
    }

    protected function setIsBestCondition(Condition $condition): void
    {
        if ($this->filter->getPageEntity() == 'Best') {
            $condition->set('t1.is_best', 1);
        }
    }

    protected function setReelsCondition(Condition $condition): void
    {
        if ($this->filter->getPageEntity() == '5 reels') {
            $condition->set('t1.reels', 5);
        }

        if ($this->filter->getReels()) {
            $condition->setIn("t1.reels", $this->filter->getReels());
        }
    }

    protected function setSlotTypesCondition(Condition $condition): void
    {
        if (!empty($this->filter->getSlotTypes())) {
            $mainClause = new \Lucinda\Query\Clause\Condition([], \Lucinda\Query\Operator\Logical::_OR_);
            $gotClause = false;

            foreach ($this->filter->getSlotTypes() as $type) {
                $clause = new \Lucinda\Query\Clause\Condition([], \Lucinda\Query\Operator\Logical::_OR_);
                switch ($type) {
                    case 'Video Slots':
                        $clause->set('t1.game_type_id', '12');
                        break;
                    case 'Classic Slots':
                        $clause->set('t1.game_type_id', '4');
                        break;
                    case '5 Reel Slots':
                        $clause->set('t1.reels', 5);
                        break;
                    case 'Penny Slots':
                        $clause->set('t1.min_cs', "0.01");
                        break;
                    case '3D Slots':
                    case 'Vegas Slots':
                    case 'Mobile Slots':
                    case 'HTML5 Slots':
                    case 'Flash Slots':
                        continue 2;
                    case 'Best Payout Slots':
                        $clause->set('t1.rtp', 97.5, Comparison::GREATER_EQUALS);
                        break;
                    default:
                        continue 2;
                }

                $gotClause = true;
                $mainClause->setGroup($clause);
            }

            if ($gotClause) {
                $condition->setGroup($mainClause);
            }
        }
    }

    protected function setThemesCondition(Condition $condition): void
    {
        if ($this->filter->getThemes()) {
            $condition->set("themes.game_id", "", Comparison::IS_NOT_NULL);
        }

        if ($this->filter->getMainTheme()) {
            $condition->set("themes2.game_id", "", Comparison::IS_NOT_NULL);
        }
    }

    protected function setNewAdvancedFilters(Condition $condition): void
    {
        if (!empty($this->filter->getMinRtp())) {
            $condition->set('t1.rtp', $this->filter->getMinRtp(), \Lucinda\Query\Operator\Comparison::GREATER_EQUALS);
        }
        if (!empty($this->filter->getMaxRtp())) {
            $condition->set('t1.rtp', $this->filter->getMaxRtp(), \Lucinda\Query\Operator\Comparison::LESSER_EQUALS);
        }
        if (!empty($this->filter->getMinMinCpl())) {
            $condition->set('t1.min_cpl', $this->filter->getMinMinCpl(), \Lucinda\Query\Operator\Comparison::GREATER_EQUALS);
        }
        if (!empty($this->filter->getMaxMinCpl())) {
            $condition->set('t1.min_cpl', $this->filter->getMaxMinCpl(), \Lucinda\Query\Operator\Comparison::LESSER_EQUALS);
        }
        if (!empty($this->filter->getMinMaxCpl())) {
            $condition->set('t1.max_cpl', $this->filter->getMinMaxCpl(), \Lucinda\Query\Operator\Comparison::GREATER_EQUALS);
        }
        if (!empty($this->filter->getMaxMaxCpl())) {
            $condition->set('t1.max_cpl', $this->filter->getMaxMaxCpl(), \Lucinda\Query\Operator\Comparison::LESSER_EQUALS);
        }
    }

    protected function setRatingsCondition(Condition $condition): void
    {
        if ($this->filter->getRatings()) {
            $minRating = false;
            foreach ($this->filter->getRatings() as $rating) {
                if (!$minRating || $minRating > $rating) $minRating = $rating;
            }
            $condition->set('gv.score', $minRating, \Lucinda\Query\Operator\Comparison::GREATER_EQUALS);
        }
    }
}
