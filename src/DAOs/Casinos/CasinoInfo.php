<?php

namespace Hlis\SlotsMateModels\DAOs\Casinos;

use Hlis\SlotsMateModels\Builders\Casino\Rating as RatingBuilder;
use Hlis\SlotsMateModels\Builders\Certification as CertificationBuilder;
use Hlis\SlotsMateModels\Builders\License as LicenseBuilder;
use Hlis\GlobalModels\DAOs\Casinos\CasinoInfo\Bonuses;
use Hlis\SlotsMateModels\Queries\Casinos\CasinoList\RatingInfo;
use Hlis\GlobalModels\DAOs\Casinos\CasinoInfo as GlobalCasinoInfo;
use Hlis\GlobalModels\Builders\Casino\Label as LabelBuilder;
use Hlis\GlobalModels\Entities\Casino;
use Hlis\SlotsMateModels\Queries\Casinos\CasinoInfo as CasinoInfoQuery;
use Hlis\SlotsMateModels\Builders\Casino\Info\Detailed as CasinoBuilder;
use Hlis\SlotsMateModels\Builders\GameType as GameTypeBuilder;
use Hlis\SlotsMateModels\Builders\GameManufacturer\Basic as GameManufacturerBuilder;
use Hlis\SlotsMateModels\Builders\BankingMethod\Basic as BankingMethodBuilder;
use Hlis\SlotsMateModels\Queries\Casinos\CasinoInfo\Labels as LabelsQuery;
use Hlis\SlotsMateModels\Queries\Casinos\CasinoInfo\GameTypes as GameTypesQuery;
use Hlis\SlotsMateModels\Queries\Casinos\CasinoInfo\Licenses as LicensesQuery;
use Hlis\SlotsMateModels\Queries\Casinos\CasinoInfo\Certifications as CertificationsQuery;
use Hlis\SlotsMateModels\Queries\Casinos\CasinoInfo\GameManufacturers as GameManufacturersQuery;
use Hlis\SlotsMateModels\Queries\Casinos\CasinoInfo\DepositMethods as DepositMethodsQuery;
use Hlis\SlotsMateModels\Queries\Casinos\CasinoInfo\WithdrawMethods as WithdrawMethodsQuery;
use Hlis\GlobalModels\Builders\Builder;
use Hlis\GlobalModels\Builders\CountryAccess;
use Hlis\GlobalModels\Builders\LocaleText;
use Hlis\GlobalModels\Queries\Query;

class CasinoInfo extends GlobalCasinoInfo
{
    protected function createTrunk(): ?Casino
    {
        $builder = new CasinoBuilder();
        $querier = new CasinoInfoQuery($this->filter);
        $row = \SQL($querier->getQuery(), $querier->getParameters())->toRow();
        if (empty($row)) {
            return null;
        }
        return $builder->build($row);
    }
    protected function appendBranches(): void
    {
        parent::appendBranches();

        $this->appendRatingInfo();
    }

    protected function appendBonuses(): void
    {
        parent::appendBonuses();

        //adding also targets to the casino bonuses
        if (!empty($this->entity->bonuses)) {
            $builder  =  new \Hlis\GlobalModels\Builders\Country();
            $query = new \Hlis\SlotsMateModels\Queries\Casinos\CasinoList\Bonuses\Targets(\array_keys($this->entity->bonuses));
            $resultSet = \SQL($query->getQuery(), $query->getParameters());
            while ($row = $resultSet->toRow()) {
                $this->entity->bonuses[$row['casino_bonus_id']]->targets[] = $builder->build($row);
            }
        }
    }

    protected function appendOperatingSystems(): void
    {
        // do nothing
    }

    protected function appendVIP(): void
    {
        // do nothing
    }

    protected function appendLabels(): void
    {
        $this->appendLinkedEntities(new LabelBuilder(), new LabelsQuery($this->filter), "labels");
    }

    protected function appendGameTypes(): void
    {
        $this->appendLinkedEntities(new GameTypeBuilder(), new GameTypesQuery($this->filter), "gameTypes");
    }

    protected function appendLicenses(): void
    {
        $this->appendLinkedEntities(new LicenseBuilder(), new LicensesQuery($this->filter), "licenses");
    }

    protected function appendCertifications(): void
    {
        $this->appendLinkedEntities(new CertificationBuilder(), new CertificationsQuery($this->filter), "certifications");
    }

    protected function appendRatingInfo(): void
    {
        $builder = new RatingBuilder();
        $query = new RatingInfo($this->filter->getId());
        $resultSet = \SQL($query->getQuery(), $query->getParameters());
        $row = $resultSet->toRow();
        if (!empty($row)) {
            $this->entity->rating = $builder->build($row);
        }
    }

    protected function appendGameManufacturers(): void
    {
        $this->appendLinkedEntities(new GameManufacturerBuilder(), new GameManufacturersQuery($this->filter), "gameManufacturers");
    }

    protected function appendDepositMethods(): void
    {
        $this->appendLinkedEntities(new BankingMethodBuilder(), new DepositMethodsQuery($this->filter), "depositMethods");
    }

    protected function appendWithdrawMethods(): void
    {
        $this->appendLinkedEntities(new BankingMethodBuilder(), new WithdrawMethodsQuery($this->filter), "withdrawMethods");
    }
}