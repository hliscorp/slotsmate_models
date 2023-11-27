<?php

namespace Hlis\SlotsMateModels\Filters;

use Hlis\GlobalModels\Filters\BankingMethod;

class Casino extends \Hlis\GlobalModels\Filters\Casino
{
    protected ?int $isLiveDealer = null;
    protected ?int $depositMinimum = null;
    protected ?int $withdrawalMinimum = null;
    protected ?bool $countReviews = false;
    protected ?string $pageType = '';
    protected ?string $label = '';
    protected ?bool $promoted = false;
    protected ?bool $free_bonus = false;
    protected ?string $bonus_type = '';
    protected ?bool $deposit = false;
    protected ?bool $withdrawal = false;
    protected ?string $url = '';
    protected ?BankingMethod $bankingMethods = null;
    protected ?bool $isPopularGameTypes = null;
    protected ?bool $isAllGameTypes = null;
    protected ?bool $isNew = null;
    protected ?bool $isBest = null;
    protected ?int $localeCountry = null;
    protected ?string $locale = null;
    protected ?int $additionalSoftware = null;

    public function setIsLiveDealer(int $isLiveDealer): void
    {
        $this->isLiveDealer = $isLiveDealer;
    }

    public function getIsLiveDealer(): ?int
    {
        return $this->isLiveDealer;
    }


    public function setDepositMinimum(int $depositMinimum): void
    {
        $this->depositMinimum = $depositMinimum;
    }

    public function getDepositMinimum(): ?int
    {
        return $this->depositMinimum;
    }


    public function setWithdrawalMinimum(int $withdrawalMinimum): void
    {
        $this->withdrawalMinimum = $withdrawalMinimum;
    }

    public function getWithdrawalMinimum(): ?int
    {
        return $this->withdrawalMinimum;
    }


    public function setPageType($data)
    {
        $this->pageType = $data;
    }

    public function getPageType(): string
    {
        return $this->pageType;
    }

    public function getCountReviews()
    {
        return $this->countReviews;
    }

    public function setCountReviews($data)
    {
        $this->countReviews = $data;
    }

    public function getCasinoLabel()
    {
        return $this->label;
    }

    public function setCasinoLabel($data)
    {
        $this->label = $data;
    }

    public function isTopRated(): bool
    {
        if ($this->getCasinoLabel() != 'Best') return false;
        return $this->isTopRated;
    }

    public function setTopRated(bool $data)
    {
        if ($this->getCasinoLabel() != 'Best') return;
        $this->isTopRated = $data;
    }

    public function getPromoted()
    {
        return $this->promoted;
    }

    public function setPromoted($data)
    {
        $this->promoted = $data;
    }

    public function getFreeBonus()
    {
        return $this->free_bonus;
    }

    public function setFreeBonus($data)
    {
        $this->free_bonus = $data;
    }

    public function getBonusType()
    {
        return $this->bonus_type;
    }

    public function setBonusType($data)
    {
        $this->bonus_type = $data;
    }

    public function getPaymentDeposit()
    {
        return $this->deposit;
    }

    public function setPaymentDeposit($data)
    {
        $this->deposit = $data;
    }

    public function getPaymentWithdrawal()
    {
        return $this->withdrawal;
    }

    public function setPaymentWithdrawal($data)
    {
        $this->withdrawal = $data;
    }

    public function setUrl($data)
    {
        $this->url = $data;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getBankingMethods(): ?BankingMethod
    {
        return $this->bankingMethods;
    }

    public function setBankingMethods(BankingMethod $bankingMethod): void
    {
        $this->bankingMethods = $bankingMethod;
    }

    public function getIsPopularGameTypes(): ?bool
    {
        return $this->isPopularGameTypes;
    }

    public function setIsPopularGameTypes(bool $isPopularGameTypes): void
    {
        $this->isPopularGameTypes = $isPopularGameTypes;
    }

    public function getIsAllGameTypes(): ?bool
    {
        return $this->isAllGameTypes;
    }

    public function setIsAllGameTypes(bool $isAllGameTypes): void
    {
        $this->isAllGameTypes = $isAllGameTypes;
    }

    public function getIsNew(): ?bool
    {
        return $this->isNew;
    }

    public function setIsNew(bool $isNew): void
    {
        $this->isNew = $isNew;
    }

    public function getIsBest(): ?bool
    {
        return $this->isBest;
    }

    public function setIsBest(bool $isBest): void
    {
        $this->isBest = $isBest;
    }

    public function setLocaleCountry(int $localeCountry): void
    {
        $this->localeCountry = $localeCountry;
    }

    public function getLocaleCountry(): ?int
    {
        return $this->localeCountry;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): void
    {
        $this->locale = $locale;
    }

    public function setAdditionalSoftware($id) {
        $this->additionalSoftware = $id;
    }

    public function getAdditionalSoftware() {
        return $this->additionalSoftware;
    }
}