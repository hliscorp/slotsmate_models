<?php

namespace Hlis\SlotsMateModels\Builders;

use Hlis\SlotsMateModels\Entities\Feedback\Comment;
use Hlis\SlotsMateModels\Entities\Game\GameFeedback as GameFeedbackEntity;
use Hlis\GlobalModels\Builders\Builder as Builder;
use Hlis\SlotsMateModels\Entities\User;
use Hlis\GlobalModels\Entities\Country;

class GameFeedback implements Builder
{
    public function build(array $item): \Entity
    {
        $feedback = $this->getEntity();
        $feedback->id = $item["id"];
        $feedback->entityId = $item["entity_id"];
        $feedback->ip = $item["ip"];
        $feedback->rating = $item["score"];
        $feedback->datetime = $item["date_added"];
        $feedback->helpful = $item["helpful"];

        if ($item['country_id']) {
            $country = new Country();
            $country->id = $item['country_id'];
            $country->name = $item['country_name'];
            $country->code = $item['country_code'];
            $feedback->country = $country;
        }

        if ($item["user_name"] || $item["user_email"]) {
            $user = new User();
            $user->name = $item["user_name"];
            $user->email = $item["user_email"];

            $feedback->user = $user;
        }

        if ($item["body"]) {
            $comment = new Comment();
            $comment->title = $item["title"];
            $comment->body = $item["body"];
            $comment->languageId = $item["language_id"];
            $comment->isOriginal = $item["is_original_language"];
            $comment->originalLanguageName = $item["original_language_name"];

            $feedback->comment = $comment;
        }

        return $feedback;
    }

    protected function getEntity(): GameFeedbackEntity
    {
        return new GameFeedbackEntity();
    }


}
