<?php

namespace Hlis\SlotsMateModels\DAOs\Games\Feedbacks;

use Lucinda\Query\Insert;
use Lucinda\Query\Select;
use Lucinda\Query\Update;

class GameStatsUpdater
{

    private int $gameId;

    public function __construct(int $gameId)
    {
        $this->gameId = $gameId;
    }

    public function update()
    {
        $query = new Select('games__feedbacks', 'gf');
        $query->fields()->add("COUNT(gf.id)", "total");
        $query->where()->set("gf.game_id", $this->gameId);

        $total = \SQL($query->toString())->toValue();

        $query = new Select('games__feedbacks', 'gf');
        $query->fields()->add("SUM(gf.score)", "total");
        $query->where()->set("gf.game_id", $this->gameId);

        $score = \SQL($query->toString())->toValue();

        $query = new Select('games__stats');
        $query->fields()->add("game_id");
        $query->where()->set("game_id", $this->gameId);

        $gameStatsId = \SQL($query->toString())->toValue();

        if ($gameStatsId) {
            $updater = new Update('games__stats');
            $updater->set([
                "votes" => ":votes",
                "score" => ":score"
            ]);

            $parameters = [
                ":votes" => $total,
                ":score" => $score
            ];

            $updater->where()->set("game_id", $this->gameId);

            \SQL($updater->toString(), $parameters)->getAffectedRows();

        } else {

            $inserter = new Insert('games__stats');
            $inserter->columns([
                'game_id',
                'votes',
                'score'
            ]);
            $inserter->values([
                ':game_id',
                ':votes',
                ':score'
            ]);

            $parameters = [
                ':game_id' => $this->gameId,
                ':votes' => $total,
                ':score' => $score
            ];

            \SQL($inserter->toString(), $parameters)->getInsertId();
        }


    }
}