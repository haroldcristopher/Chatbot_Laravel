<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use App\Conversations\DateTimeConversation;

class SelectServiceConversation extends Conversation
{
    public function askService()
    {
        $question = Question::create('What kind of Course you are looking for?')
            ->callbackId('select_service')
            ->addButtons([
                Button::create('Java')->value('Java'),
                Button::create('Python')->value('Python'),
                Button::create('php')->value('php'),
            ]);

        $this->ask($question, function(Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->bot->userStorage()->save([
                    'service' => $answer->getValue(),
                ]);
            }
        });
        $this->bot->startConversation(new DateTimeConversation());
    }

    public function run()
    {
        $this->askService();
    }
}
