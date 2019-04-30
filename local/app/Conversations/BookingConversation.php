<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;

class BookingConversation extends Conversation
{
    public function confirmBooking()
    {
        $user = $this->bot->userStorage()->find();
        //dd($user);

        $message = '-------------------------------------- <br>';
        $message .= 'Course : ' . $user->get('service') . '<br>';
        $message .= 'Teacher : ' . $user->get('teacher') . '<br>';
        $message .= 'Name : ' . $user->get('name') . '<br>';
        $message .= 'Email : ' . $user->get('email') . '<br>';
        $message .= 'Mobile : ' . $user->get('mobile') . '<br>';
        $message .= 'Address : ' . $user->get('address') . '<br>';
        $message .= 'Date : ' . $user->get('date') . '<br>';
        $message .= 'Time : ' . $user->get('timeSlot') . '<br>';
        $message .= '---------------------------------------';

        $this->say('Great. Your booking has been confirmed. Here is your booking details. <br><br>' . $message);
    }

    public function run()
    {
        $this->confirmBooking();
    }
}
