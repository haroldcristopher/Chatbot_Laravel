<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');


// $botman->hears('Hi|Hello', function ($bot) {
// 	$greetings = "";
//     $time = date("H");
//     $timezone = date("e");
//     if ($time < "12") {
//         $greetings = "Good morning";
//     } else
//     if ($time >= "12" && $time < "17") {
//         $greetings = "Good afternoon";
//     } else
//     if ($time >= "17" && $time < "19") {
//         $greetings = "Good evening";
//     } else
//     if ($time >= "19") {
//         $greetings = "Good night";
//     }
//     $bot->reply('Hello '.$greetings);
// });

$botman->hears('How are you', function ($bot) {
    $bot->reply('Fine,Thank you');
});
$botman->hears('Who are you ?', function ($bot) {
    $bot->reply(' I am alexa');
});
$botman->hears('You are a Male ?', function ($bot) {
    $bot->reply('No,Female');
});
// $botman->hears('Hi|Hello', BotManController::class.'@normalConversation');
$botman->hears('Hi|Hello', BotManController::class.'@greetConversation');

$botman->hears('Start conversation|start', BotManController::class.'@startConversation');

$botman->hears('Help me', BotManController::class.'@askHelpToAlex');

$botman->hears('ask me', BotManController::class.'@normalConversation');
