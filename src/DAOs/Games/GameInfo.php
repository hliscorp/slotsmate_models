<?php

namespace Hlis\SlotsMateModels\DAOs\Games;

use Hlis\GlobalModels\Builders\Game\Collection as CollectionBuilder;
use Hlis\GlobalModels\Queries\Games\GameInfo\Collection as CollectionQuery;
use Hlis\GlobalModels\DAOs\Games\GameInfo as GlobalGameInfo;
use Hlis\GlobalModels\Builders\Game\FeaturesGallery as FeaturesGalleryBuilder;
use Hlis\GlobalModels\Builders\Game\HowToPlay as HowToPlayBuilder;

use Hlis\SlotsMateModels\Queries\Games\GameInfo\HowToPlay as HowToPlayQuery;
use Hlis\SlotsMateModels\Queries\Games\GameInfo\FeaturesGallery as FeaturesGalleryQuery;
use Hlis\SlotsMateModels\Builders\Game\GameInfo as GameInfoBuilder;
use Hlis\SlotsMateModels\Queries\Games\GameInfo as GameInfoQuery;
use Hlis\SlotsMateModels\Queries\Games\GameInfo\PaylinesGallery as PaylinesGalleryQuery;
use Hlis\SlotsMateModels\Entities\Game\Game as GameEntity;
use Hlis\SlotsMateModels\DAOs\Games\GamePaytable as GamePaytable;

class GameInfo extends GlobalGameInfo
{
    protected function createTrunk(): ?GameEntity
    {
        $builder = new GameInfoBuilder();
        $querier = new GameInfoQuery($this->filter);
        $row = SQL($querier->getQuery(), $querier->getParameters())->toRow();
        if (empty($row)) {
            return null;
        }
        return $builder->build($row);
    }

    protected function appendBranches(): void
    {
        // advanced features
        $this->setAdvancedFeatures();
        // themes
        $this->appendThemes();
        $this->appendVideoGallery();
        $this->appendVideoTimelines();
        $this->appendPaytable();
        $this->appendPaylinesGallery();
        $this->appendFeaturesGallery();
        $this->appendHowToPlays();
        $this->appendRtpInfo();
    }

    protected function appendVideoTimelines(): void
    {
        // do nothing
    }

    protected function appendPaytable(): void
    {
        $paytableModel = new GamePaytable($this->filter);
        $this->entity->paytable = $paytableModel->getPaytable();
    }

    protected function appendPaylinesGallery(): void
    {
        $galleryQuery = new PaylinesGalleryQuery($this->filter);
        $galleryResults = \SQL($galleryQuery->getQuery(), $galleryQuery->getParameters());
        while ($row = $galleryResults->toRow()) {
            $this->entity->paylineGalleries[] = $row['file_name'];
        }
    }

    private function appendFeaturesGallery(): void
    {
        $builder = new FeaturesGalleryBuilder();
        $galleryQuery = new FeaturesGalleryQuery($this->filter);
        $galleryResults = \SQL($galleryQuery->getQuery(), $galleryQuery->getParameters());
        while ($row = $galleryResults->toRow()) {
            $this->entity->featureGalleries[$row['feature_name']][] = $builder->build($row);
        }
    }

    private function appendHowToPlays(): void
    {
        $builder = new HowToPlayBuilder();
        $query = new HowToPlayQuery($this->filter);
        $results = \SQL($query->getQuery(), $query->getParameters());
        while ($row = $results->toRow()) {
            $this->entity->howToPlays[$row['step']] = $builder->build($row);
        }
    }

    protected function getEntity(): GameEntity
    {
        return new GameEntity();
    }
}