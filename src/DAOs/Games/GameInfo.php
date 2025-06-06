<?php
namespace Hlis\SlotsMateModels\DAOs\Games;

use Hlis\SlotsMateModels\Builders\Game\FAQ;
use Hlis\SlotsMateModels\Queries\Games\GameInfo\FAQ as FAQQuery;

use Hlis\GlobalModels\Builders\Game\Collection as CollectionBuilder;
use Hlis\GlobalModels\Builders\Game\FeaturesGallery as FeaturesGalleryBuilder;
use Hlis\GlobalModels\Builders\Game\HowToPlay as HowToPlayBuilder;
use Hlis\GlobalModels\DAOs\Games\GameInfo as GlobalGameInfo;
use Hlis\GlobalModels\DAOs\Games\GameFeatures;
use Hlis\GlobalModels\Queries\Games\GameInfo\Collection as CollectionQuery;
use Hlis\SlotsMateModels\Builders\Game\GameInfo as GameInfoBuilder;
use Hlis\SlotsMateModels\Builders\Game\Rating;
use Hlis\SlotsMateModels\DAOs\Games\GamePaytable as GamePaytable;
use Hlis\SlotsMateModels\Entities\Game as GameEntity;
use Hlis\SlotsMateModels\Queries\Games\GameInfo as GameInfoQuery;
use Hlis\SlotsMateModels\Queries\Games\GameInfo\FeaturesGallery as FeaturesGalleryQuery;
use Hlis\SlotsMateModels\Queries\Games\GameInfo\GameVotes;
use Hlis\SlotsMateModels\Queries\Games\GameInfo\HowToPlay as HowToPlayQuery;
use Hlis\SlotsMateModels\Queries\Games\GameInfo\PaylinesGallery as PaylinesGalleryQuery;
use Hlis\SlotsMateModels\Queries\Games\Rating as RatingQuery;

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
        $this->appendLinkedEntities(new CollectionBuilder, new CollectionQuery($this->filter), "collections");
        $this->setAdvancedFeatures();
        $this->appendThemes();
        $this->appendVideoGallery();
        $this->appendVideoTimelines();
        $this->appendPaytable();
        $this->appendPaylinesGallery();
        $this->appendFeaturesGallery();
        $this->appendHowToPlays();
        $this->appendRtpInfo();
        $this->appendGameVotes();
        $this->appendGameVotesStatistics();
        $this->appendTimesPlayed();

        $this->appendFAQ();
    }

    protected function setAdvancedFeatures(): void
    {
        $dao = new GameFeatures($this->filter);
        $advancedFeatures = $dao->getFeatures();

        foreach($advancedFeatures as $feature) {
            $columnName = "is".str_replace([" ","-"], "", ucwords($feature->name));
            $this->entity->features->$columnName = true;
        }
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

    protected function appendGameVotes(): void
    {
        $query = new GameVotes($this->filter);
        $results = \SQL($query->getQuery(), $query->getParameters());
        while ($row = $results->toRow()) {
            $this->entity->score = $row['score'];
        }
    }

    protected function appendGameVotesStatistics(): void
    {
        $query = new RatingQuery($this->filter);
        $results = \SQL($query->getQuery(), $query->getParameters())->toColumn();
        $builder = new Rating();
        $this->entity->rating = $builder->build($results);
    }

    protected function appendTimesPlayed(): void
    {
        $query = new \Hlis\SlotsMateModels\Queries\Games\GameInfo\TimesPlayed($this->filter);
        $resultSet = \SQL($query->getQuery(), $query->getParameters());
        while ($row = $resultSet->toRow()) {
            $this->entity->timesPlayed = $row["times_played"];
        }
    }

    protected function appendFAQ(): void
    {
        $faqQuery = new FAQQuery($this->filter);
        $faqResults = SQL($faqQuery->getQuery(), $faqQuery->getParameters())->toList();
        if (!empty($faqResults)) {
            //placeholders will be replaced on the GameInfoConverter level
            $builder = new FAQ();
            foreach ($faqResults as $row) {
                $this->entity->faq[] = $builder->build($row);
            }
        }
    }
}