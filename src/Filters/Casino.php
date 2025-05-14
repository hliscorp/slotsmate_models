<?php

namespace Hlis\SlotsMateModels\Filters;

use Hlis\GlobalModels\Filters\BankingMethod;

class Casino extends \Hlis\GlobalModels\Filters\Casino
{
    protected ?bool $hasApp = null;
    protected ?int $isLiveDealer = null;
    protected ?int $ratingMinimum = null;
    protected ?int $depositMinimum = null;
    protected ?int $withdrawalMinimum = null;
    protected ?bool $countReviews = false;
    protected ?string $pageType = '';
    protected ?bool $promoted = false;
    protected ?bool $free_bonus = false;
    protected ?bool $deposit = false;
    protected ?bool $withdrawal = false;
    protected ?bool $isTopRated = false;
    protected ?string $url = '';
    protected ?BankingMethod $bankingMethods = null;
    protected ?bool $isPopularGameTypes = null;
    protected ?bool $isAllGameTypes = null;
    protected ?bool $isNew = null;
    protected ?bool $isBest = null;
    protected ?int $localeCountry = null;
    protected ?int $additionalSoftware = null;
    protected ?array $depositRange = null;
    protected ?bool $statusOpposite = null;
    protected ?bool $isInstantWithdrawal = null;
    protected array $withdrawalTimeframeBankingMethodTypes = [];
    protected ?int $customCasinoCategory = null;

    public function getWithdrawalTimeframeBankingMethodTypes(): array
    {
        return $this->withdrawalTimeframeBankingMethodTypes;
    }

    public function addWithdrawalTimeframeBankingMethodTypes(int $type): void
    {
        $this->withdrawalTimeframeBankingMethodTypes[$type] = $type;
    }

    public function setStatusOpposite(bool $value): self
    {
        $this->statusOpposite = $value;
        return $this;
    }

    public function getStatusOpposite(): ?bool
    {
        return $this->statusOpposite;
    }

    public function setIsLiveDealer(int $isLiveDealer): void
    {
        $this->isLiveDealer = $isLiveDealer;
    }

    public function getIsLiveDealer(): ?int
    {
        return $this->isLiveDealer;
    }

    public function setRatingMinimum(int $ratingMinimum): void
    {
        $this->ratingMinimum = $ratingMinimum;
    }

    public function getRatingMinimum(): ?int
    {
        return $this->ratingMinimum;
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

    public function isTopRated(): bool
    {
        return $this->isTopRated;
    }

    public function setTopRated(bool $data)
    {
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

    public function setAdditionalSoftware($id)
    {
        $this->additionalSoftware = $id;
    }

    public function getAdditionalSoftware()
    {
        return $this->additionalSoftware;
    }

    public function getHasApp(): ?bool
    {
        return $this->hasApp;
    }

    public function setHasApp(bool $hasApp): void
    {
        $this->hasApp = $hasApp;
    }

    public function clearGameTypes(): void
    {
        $this->gameTypes = [];
    }

    public function clearCurrencies(): void
    {
        $this->currencies = [];
    }

    public function clearOperatingSystems(): void
    {
        $this->operatingSystems = [];
    }

    public function setDepositRange(int $min, int $max): self
    {
        $this->depositRange = [$min, $max];
        return $this;
    }

    public function getDepositRange(): ?array
    {
        return $this->depositRange;
    }

    public function setIsInstantWithdrawal(bool $value): self
    {
        $this->isInstantWithdrawal = $value;
        return $this;
    }

    public function getIsInstantWithdrawal(): ?bool
    {
        return $this->isInstantWithdrawal;
    }

    public function setCustomCasinoCategory(int $customCasinoCategory): self
    {
        $this->customCasinoCategory = $customCasinoCategory;
        return $this;
    }

    public function getCustomCasinoCategory(): ?int
    {
        return $this->customCasinoCategory;
    }
}