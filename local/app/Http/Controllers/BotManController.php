<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use App\Conversations\ExampleConversation;
use App\Conversations\SimplemessageConversation;
use App\Conversations\OnboardingConversation;
use App\Conversations\GreetingConversation;
class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

        $botman->listen();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tinker()
    {
        return view('tinker');
    }

    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */
    public function startConversation(BotMan $bot)
    {
        $bot->startConversation(new ExampleConversation());
       

        
    }

    public function askHelpToAlex(BotMan $bot)
    {
        $bot->startConversation(new SimplemessageConversation());
    }

    public function normalConversation(BotMan $bot)
    {
        $bot->startConversation(new OnboardingConversation());
    }

    public function greetConversation(BotMan $bot)
    {
        $bot->startConversation(new GreetingConversation());
    }
}
