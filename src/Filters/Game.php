<?php

namespace Hlis\SlotsMateModels\Filters;

use Hlis\GlobalModels\Filters\Game as GamesFilter;

class Game extends GamesFilter
{
    protected ?array $themes = null;
    protected ?int $mainTheme = null;
    protected ?array $features = null;
    protected ?int $mainFeature = null;
    protected ?array $volatility = null;
    protected ?array $excludeIds = null;
    protected ?string $pageEntity = null;
    protected ?int $gameType = null;
    protected ?bool $upcoming = null;
    protected ?string $sectionType = null;
    protected ?array $slotTypes = null;
    protected ?array $ratings = null;
    protected ?int $reels = null;
    protected ?string $min_date = null;
    protected ?int $min_score = null;
    protected ?int $min_votes = null;
    protected ?float $min_rtp = null;
    protected ?float $max_rtp = null;
    protected ?int $min_min_cpl = null;
    protected ?int $max_min_cpl = null;
    protected ?int $min_max_cpl = null;
    protected ?int $max_max_cpl = null;
    protected ?bool $hasGameImpressions = null;
    protected ?int $sort = null;
    protected ?string $ignoreDateLaunch = null;
    private ?string $search = null;
    protected int $locale = 1; //en default locale

    public function getSearch(): ?string
    {
        return $this->search;
    }

    public function setSearch(string $search): void
    {
        $this->search = $search;
    }

    public function setThemes(?int $theme)
    {
        $this->themes[] = $theme;
    }

    public function getThemes(): ?array
    {
        return $this->themes;
    }

    public function setMainTheme(?int $mainTheme)
    {
        $this->mainTheme = $mainTheme;
    }

    public function getMainTheme(): ?string
    {
        return $this->mainTheme;
    }

    public function setFeatures(?int $feature)
    {
        $this->features[] = $feature;
    }

    public function getFeatures(): ?array
    {
        return $this->features;
    }

    public function setMainFeature(?int $mainFeature)
    {
        $this->mainFeature = $mainFeature;
    }

    public function getMainFeature(): ?string
    {
        return $this->mainFeature;
    }

    public function setVolatility(?int $volatility)
    {
        $this->volatility[] = $volatility;
    }

    public function getVolatility(): ?array
    {
        return $this->volatility;
    }

    public function setExcludeIds(?int $excludeId)
    {
        $this->excludeIds[] = $excludeId;
    }

    public function getExcludeIds(): ?array
    {
        return $this->excludeIds;
    }

    public function setPageEntity(?string $pageEntity)
    {
        $this->pageEntity = $pageEntity;
    }

    public function getPageEntity(): ?string
    {
        return $this->pageEntity;
    }

    public function setGameType(?int $gameType)
    {
        $this->gameType = $gameType;
    }

    public function getGameType(): ?string
    {
        return $this->gameType;
    }

    public function setUpcoming(?bool $upcoming)
    {
        $this->upcoming = $upcoming;
    }

    public function getUpcoming(): ?bool
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

    public function setMinVotes(?int $min_votes)
    {
        $this->min_votes = $min_votes;
    }

    public function getMinVotes(): ?int
    {
        return $this->min_votes;
    }


    public function setMinRtp(?float $min_rtp)
    {
        $this->min_rtp = $min_rtp;
    }

    public function getMinRtp(): ?float
    {
        return $this->min_rtp;
    }

    public function setMaxRtp(?float $max_rtp)
    {
        $this->max_rtp = $max_rtp;
    }

    public function getMaxRtp(): ?float
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

    public function setGameImpressions(?bool $hasGameImpressions)
    {
        $this->hasGameImpressions = $hasGameImpressions;
    }

    public function getGameImpressions(): ?bool
    {
        return $this->hasGameImpressions;
    }

    public function setSort(?int $sort)
    {
        $this->sort = $sort;
    }

    public function getSort(): ?int
    {
        return $this->sort;
    }

    public function setIgnoreDateLaunch(?string $ignoreDateLaunch)
    {
        $this->ignoreDateLaunch = $ignoreDateLaunch;
    }

    public function getIgnoreDateLaunch(): ?string
    {
        return $this->ignoreDateLaunch;
    }

    public function getLocale(): int
    {
        return $this->locale;
    }

    public function setLocale(int $locale): void
    {
        $this->locale = $locale;
    }
}
