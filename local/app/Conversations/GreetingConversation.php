<?php

namespace App\Conversations;

// use BotMan\BotMan\Messages\Conversations\Conversation;
use Validator;
use Carbon\Carbon;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use App\Conversations\OnboardingConversation;

class GreetingConversation extends Conversation
{
	public function askService()
    {
    	$greetings = "";
    $time = date("H");
    $timezone = date("e");
    if ($time < "12") {
        $greetings = "Good morning";
    } else
    if ($time >= "12" && $time < "17") {
        $greetings = "Good afternoon";
    } else
    if ($time >= "17" && $time < "19") {
        $greetings = "Good evening";
    } else
    if ($time >= "19") {
        $greetings = "Good night";
    }
    	$this->say('Hello '.$greetings);
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
            $this->getAns('service',$answer->getValue());
        });

        //$this->bot->startConversation(new DateTimeConversation());
    }

    public function getAns($type,$value)
    {
    	if($type == 'service')
    	{
    		$this->say('Great, you are selecting '.$value);
    		 $this->askTeacher($value);
    	}
    }
    public function askTeacher($value)
    {
    	if($value == 'Java')
    	{
    		$question = Question::create('select teacher')
            ->callbackId('select_tech')
            ->addButtons([
                Button::create('durga')->value('durga'),
                Button::create('nagoor')->value('nagoor'),
                Button::create('sriman')->value('sriman'),
            ]);

        $this->ask($question, function(Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->bot->userStorage()->save([
                    'teacher' => $answer->getValue(),
                ]);
            }
            $this->say('Great, you are selecting '.$answer->getValue());
            $this->askDate();
        });
    	}
    	else if($value == 'Python')
    	{
    		$question = Question::create('select teacher')
            ->callbackId('select_tech')
            ->addButtons([
                Button::create('satish')->value('satish'),
                Button::create('ganesh')->value('ganesh'),
            ]);

        $this->ask($question, function(Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->bot->userStorage()->save([
                    'service' => $answer->getValue(),
                ]);
            }
            $this->say('Great, you are selecting '.$answer->getValue());
            $this->askDate();
        });
    	}
    	else if($value == 'php')
    	{
    		$question = Question::create('select teacher')
            ->callbackId('select_tech')
            ->addButtons([
                Button::create('swamy naidu')->value('swamy naidu'),
                Button::create('samba')->value('samba'),
            ]);

        $this->ask($question, function(Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->bot->userStorage()->save([
                    'service' => $answer->getValue(),
                ]);
            }
            $this->say('Great, you are selecting '.$answer->getValue());
            $this->askDate();
        });
    	}
    }
    public function askDate()
    {
        $availableDates = [
            Carbon::today()->addDays(1),
            Carbon::today()->addDays(2),
            Carbon::today()->addDays(3)         ];

        $question = Question::create('Select joining date')
            ->callbackId('select_date')
            ->addButtons([
                Button::create($availableDates[0]->format('M d'))->value($availableDates[0]->format('Y-m-d')),
                Button::create($availableDates[1]->format('M d'))->value($availableDates[1]->format('Y-m-d')),
                Button::create($availableDates[2]->format('M d'))->value($availableDates[2]->format('Y-m-d')),
            ]);

        $this->ask($question, function(Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->bot->userStorage()->save([
                    'date' => $answer->getValue(),
                ]);
                $this->say('Great, you are selecting '.$answer->getValue());
                $this->askTime();
            }
        });
    }

    public function askTime()
    {
        $question = Question::create('Select a prefare time')
            ->callbackId('select_time')
            ->addButtons([
                Button::create('9 AM')->value('9 AM'),
                Button::create('1 PM')->value('1 PM'),
                Button::create('3 PM')->value('3 PM'),
            ]);

        $this->ask($question, function(Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->bot->userStorage()->save([
                    'timeSlot' => $answer->getValue(),
                ]);
                $this->say('Great, you are selecting '.$answer->getValue());
                $this->bot->startConversation(new OnboardingConversation());
            }
        });
        
        
        
    }
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->askService();
    }
}
