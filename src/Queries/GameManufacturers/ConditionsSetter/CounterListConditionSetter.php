<?php

namespace Hlis\SlotsMateModels\Queries\GameManufacturers\ConditionsSetter;
use Hlis\GlobalModels\Queries\GameManufacturers\ConditionsSetter\GameManufacturerConditions;
use Lucinda\Query\Clause\Condition;
class CounterListConditionSetter extends GameManufacturerConditions
{
    public function appendConditions(Condition $condition): void
    {
        $this->setIsLive($condition);
        $this->setDevice($condition);
        $this->setGameIsOpen($condition);
        $this->setFeaturesCondition($condition);
        $this->setVolatilityCondition($condition);
        $this->setIsNewCondition($condition);
        $this->setThemesCondition($condition);
        $this->setGameTypeCondition($condition);
        $this->setIsMain($condition);
        $this->setExcludedIdsCondition($condition);
        $this->setIsCountryAcceptedCondition($condition);
    }

    protected function setIsLive(Condition $condition): void
    {
        if ($this->filter->getIsLive()) {
            $condition->set("t6.is_live", 1);
        }
    }

    protected function setIsCountryAcceptedCondition(Condition $condition): void {
        $condition->setIn("t2.game_type_id", [12, 4]);
        $clause = new \Lucinda\Query\Clause\Condition([], \Lucinda\Query\Operator\Logical::_OR_);
        $clause->setIsNull("t7.id");
        $clause->set("t7.is_allowed", 1);
        $condition->setGroup($clause);
        $date = date("Y-m-d");
        $condition->set("COALESCE(t2.date_launched, '0000-00-00')", $date,\Lucinda\Query\Operator\Comparison::LESSER_EQUALS);
    }

    protected function setDevice(Condition $condition): void
    {
        if ($this->filter->getDevice()) {
            $device = $this->filter->getDevice();
            $condition->set("t2.{$device}", 1);
        }
    }

    protected function setGameIsOpen(Condition $condition): void
    {
            $condition->set("t2.is_open", 1);
    }

    protected function setSlotsCondition(Condition $condition): void
    {
            $type = strtolower($this->filter->getSlotLabel());
            if($type != "video" && $type != "slots") {
                $condition->setIn("t2.game_type_id",[12,4]);
            }
            switch ($type) {
                case "rtp":
                    $condition->set('t2.rtp', 97.5, Lucinda\Query\Operator\Comparison::GREATER_EQUALS);
                    break;
                case "video":
                    $condition->set('t2.game_type_id', 12);
                    break;
                case "slots":
                    $condition->set('t2.game_type_id', 4);
                    break;
                case 'free slots':
                    $condition->set("COALESCE(t2.date_launched, '0000-00-00')", "'" . date("Y-m-d") . "'", Lucinda\Query\Operator\Comparison::LESSER_EQUALS);
                    break;
                case "penny":
                    $condition->set('t2.min_cs', 0.01);
                    break;
                case "vegas":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 15"]);
                    break;
                case "mobile":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 7"]);
                    break;
                case "desktop":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 8"]);
                    break;
                case "3d":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id IN (11,12)"]);
                    break;
                case "3d animation":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 11"]);
                    break;
                case "3d technology":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 12"]);
                    break;
                case "bonus round":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 1"]);
                    break;
                case "free spins":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 5"]);
                    break;
                case "scatter":
                case "scatter symbol":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 3"]);
                    break;
                case "wild":
                case "wild symbol":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 2"]);
                    break;
                case "multiplier":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 4"]);
                    break;
                case "autoplay":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 14"]);
                    break;
                case "nudges":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 18"]);
                    break;
                case "flash":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 10"]);
                    break;
                case "live dealer":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 13"]);
                    break;
                case "macau":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 16"]);
                    break;
                case "html5":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 9"]);
                    break;
                case "colossal reels":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 19"]);
                    break;
                case "cascading reels":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 20"]);
                    break;
                case "hold feature":
                case "slots hold":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 33"]);
                    break;
                case "reel respins":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 30"]);
                    break;
                case "rotating reels":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 31"]);
                    break;
                case "split symbol":
                case "split symbols":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 29"]);
                    break;
                case "walking wilds":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 28"]);
                    break;
                case "random wilds":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 27"]);
                    break;
                case "transferring wilds":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 26"]);
                    break;
                case "sticky wilds":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 25"]);
                    break;
                case "stacked wilds":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 24"]);
                    break;
                case "shifting wilds":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 23"]);
                    break;
                case "expanding wilds":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 22"]);
                    break;
                case "retrigger":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 32"]);
                    break;
                case "gamble feature":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 34"]);
                    break;
                case "progressive":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 6"]);
                    break;
                case "non-progressive":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 17"]);
                    break;
                case "win both ways":
                    $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id = 21"]);
                    break;
                case "new":
                    $condition->set("t2.date_launched", "'" . date("Y-m-d", strtotime("-1 year", time())) . "'", Lucinda\Query\Operator\Comparison::GREATER);
                    $condition->set("t2.date_launched", "'" . date("Y-m-d") . "'", Lucinda\Query\Operator\Comparison::LESSER_EQUALS);
                    break;
                case "best":
                    $condition->set("COALESCE(t2.date_launched, '0000-00-00')", "'" . date("Y-m-d") . "'", Lucinda\Query\Operator\Comparison::LESSER_EQUALS);
                    $condition->set('t2.is_best', 1);
                    break;
                case "5 reels":
                    $condition->set("t2.reels", 5);
                    break;
            }
    }

    protected function setFeaturesCondition(Condition $condition): void
    {
        if ($this->filter->getFeatures()) {
            $features = $this->filter->getFeatures();
            $condition->setIn('t2.id', ["SELECT game_id FROM games__features WHERE feature_id IN (" . implode(',', $features) . ")"]);
        }
    }

    protected function setVolatilityCondition(Condition $condition): void {
        if ($this->filter->getVolatility()) {
            $condition->set("t2.game_volatility_id", $this->filter->getVolatility());
        }
    }

    protected function setIsNewCondition(Condition $condition): void {
        if ($this->filter->getIsNew()) {
            $condition->setBetween("t2.date_launched", "'".date("Y-m-d", strtotime("-1 year", time()))."'", "'". date("Y-m-d") ."'");
        }
    }

    protected function setThemesCondition(Condition $condition): void {
        if ($this->filter->getThemes()) {
            $themes = $this->filter->getThemes();
            foreach ($themes as $theme) {
                $condition->setIn('t2.id', ["SELECT game_id FROM games__themes WHERE theme_id = {$theme}"]);
            }
        }
    }

    protected function setGameTypeCondition(Condition $condition): void {
        if ($this->filter->getGameTypes()) {
            $condition->setIn("t2.game_type_id", implode(',', $this->filter->getGameType()));
        } elseif ($this->filter->getSlotLabel()) {
            $this->setSlotsCondition($condition);
        } else {
            $condition->setIn("t2.game_type_id", [12, 4]);
        }
    }

    protected function setIsMain(Condition $condition): void {
        if ($this->filter->getIsMain()) {
            $condition->set("t1.main",1);
        }
    }

    protected function setExcludedIdsCondition(Condition $condition): void
    {
        if ($excludedIds = $this->filter->getExcludedIds()) {
            $condition->setIn("t1.id", $excludedIds, false);
        }
    }

}