<?php

namespace App\Conversations;

use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class SimplemessageConversation extends Conversation
{
    /**
     * First question
     */
    public function askReason()
    {
        $question = Question::create("What type of help you needed?")
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('Tell a joke')->value('joke'),
                Button::create('Give me a fancy quote')->value('quote'),
                Button::create('Tell me about avontix')->value('avontix'),
            ]);

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'joke') {
                    $joke = json_decode(file_get_contents('http://api.icndb.com/jokes/random'));
                    $this->say($joke->value->joke);
                } elseif($answer->getValue() === 'quote') {
                    $this->say(Inspiring::quote());
                }else
                {
                    $url = 'https://avontix.com';
                    $this->say($url);
                }
            }
        });

    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->askReason();
    }
}
