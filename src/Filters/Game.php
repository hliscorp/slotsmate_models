<?php

namespace Hlis\SlotsMateModels\Filters;

use Hlis\GlobalModels\Filters\Game as GamesFilter;

class Game extends GamesFilter
{
    protected ?array $themes = null;
    protected ?string $mainTheme = null;
    protected ?array $features = null;
    protected ?array $volatility = null;
    protected ?array $excludeIds = null;
    protected ?string $url = null;
    protected ?string $pageEntity = null;
    protected ?string $key = null;
    protected ?string $gameType = null;
    protected ?string $upcoming = null;
    protected ?string $sectionType = null;
    protected ?string $search = null;
    protected ?array $volatilityIds = null;
    protected ?array $slotTypes = null;
    protected ?array $ratings = null;
    protected ?int $reels = null;
    protected ?string $min_date = null;
    protected ?int $min_score = null;
    protected ?int $min_rtp = null;
    protected ?int $max_rtp = null;
    protected ?int $min_min_cpl = null;
    protected ?int $max_min_cpl = null;
    protected ?int $min_max_cpl = null;
    protected ?int $max_max_cpl = null;
    protected ?bool $gameImpressions = null;
    protected ?string $ignoreDateLaunch = null;
    protected ?int $writerID = null;
    protected ?array $additional_softwares = null;
    protected ?bool $isCountQuery = null;

    public function setThemes(?string $theme)
    {
        $this->themes[] = $theme;
    }

    public function getThemes(): ?array
    {
        return $this->themes;
    }

    public function setMainTheme(?string $mainTheme)
    {
        $this->mainTheme = $mainTheme;
    }

    public function getMainTheme(): ?string
    {
        return $this->mainTheme;
    }

    public function setFeatures(?string $feature)
    {
        $this->features[] = $feature;
    }

    public function getFeatures(): ?array
    {
        return $this->features;
    }

    public function setVolatility(?string $volatility)
    {
        $this->volatility[] = $volatility;
    }

    public function getVolatility(): ?array
    {
        return $this->volatility;
    }

    public function setExcludeIds(?string $excludeId)
    {
        $this->excludeIds[] = $excludeId;
    }

    public function getExcludeIds(): ?array
    {
        return $this->excludeIds;
    }

    public function setUrl(?string $url)
    {
        $this->url = $url;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setPageEntity(?string $pageEntity)
    {
        $this->pageEntity = $pageEntity;
    }

    public function getPageEntity(): ?string
    {
        return $this->pageEntity;
    }

    public function setKey(?string $key)
    {
        $this->key = $key;
    }

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function setGameType(?string $gameType)
    {
        $this->gameType = $gameType;
    }

    public function getGameType(): ?string
    {
        return $this->gameType;
    }

    public function setUpcoming(?string $upcoming)
    {
        $this->upcoming = $upcoming;
    }

    public function getUpcoming(): ?string
    {
        return $this->upcoming;
    }

    public function setSectionType(?string $sectionType)
    {
        $this->sectionType = $sectionType;
    }

    public function getSectionType(): ?string
    {
        return $this->sectionType;
    }

    public function setSearch(?string $search)
    {
        $this->search = $search;
    }

    public function getSearch(): ?string
    {
        return $this->search;
    }

    public function setVolatilityIds(?string $volatilityId)
    {
        $this->volatilityIds[] = $volatilityId;
    }

    public function getVolatilityIds(): ?array
    {
        return $this->volatilityIds;
    }

    public function setSlotTypes(?string $slotType)
    {
        $this->slotTypes[] = $slotType;
    }

    public function getSlotTypes(): ?array
    {
        return $this->slotTypes;
    }

    public function setRatings(?int $ratings)
    {
        $this->ratings[] = $ratings;
    }

    public function getRatings(): ?array
    {
        return $this->ratings;
    }

    public function setReels(?int $reels)
    {
        $this->reels = $reels;
    }

    public function getReels(): ?int
    {
        return $this->reels;
    }

    public function setMinDate(?string $min_date)
    {
        $this->min_date = $min_date;
    }

    public function getMinDate(): ?string
    {
        return $this->min_date;
    }

    public function setMinScore(?int $min_score)
    {
        $this->min_score = $min_score;
    }

    public function getMinScore(): ?int
    {
        return $this->min_score;
    }

    public function setMinRtp(?int $min_rtp)
    {
        $this->min_rtp = $min_rtp;
    }

    public function getMinRtp(): ?int
    {
        return $this->min_rtp;
    }

    public function setMaxRtp(?int $max_rtp)
    {
        $this->max_rtp = $max_rtp;
    }

    public function getMaxRtp(): ?int
    {
        return $this->max_rtp;
    }

    public function setMinMinCpl(?int $min_min_cpl)
    {
        $this->min_min_cpl = $min_min_cpl;
    }

    public function getMinMinCpl(): ?int
    {
        return $this->min_min_cpl;
    }

    public function setMaxMinCpl(?int $max_min_cpl)
    {
        $this->max_min_cpl = $max_min_cpl;
    }

    public function getMaxMinCpl(): ?int
    {
        return $this->max_min_cpl;
    }

    public function setMinMaxCpl(?int $min_max_cpl)
    {
        $this->min_max_cpl = $min_max_cpl;
    }

    public function getMinMaxCpl(): ?int
    {
        return $this->min_max_cpl;
    }

    public function setMaxMaxCpl(?int $max_max_cpl)
    {
        $this->max_max_cpl = $max_max_cpl;
    }

    public function getMaxMaxCpl(): ?int
    {
        return $this->max_max_cpl;
    }

    public function setGameImpressions(?bool $gameImpressions)
    {
        $this->gameImpressions = $gameImpressions;
    }

    public function getGameImpressions(): ?bool
    {
        return $this->gameImpressions;
    }

    public function setIgnoreDateLaunch(?string $ignoreDateLaunch)
    {
        $this->ignoreDateLaunch = $ignoreDateLaunch;
    }

    public function getIgnoreDateLaunch(): ?string
    {
        return $this->ignoreDateLaunch;
    }

    public function setWriterID(?int $writerID)
    {
        $this->writerID = $writerID;
    }

    public function getWriterID(): ?int
    {
        return $this->writerID;
    }

    public function setAdditionalSoftwares(?string $additional_softwares)
    {
        $this->additional_softwares[] = $additional_softwares;
    }

    public function getAdditionalSoftwares(): ?array
    {
        return $this->additional_softwares;
    }

    public function setIsCountQuery(?bool $isCountQuery)
    {
        $this->isCountQuery = $isCountQuery;
    }

    public function getIsCountQuery(): ?bool
    {
        return $this->isCountQuery;
    }



}