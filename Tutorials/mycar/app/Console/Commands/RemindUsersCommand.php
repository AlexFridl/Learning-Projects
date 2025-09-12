<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ReminderNotification;
use App\Notifications\ReminderMailNotification;
use App\Reminder;

class RemindUsersCommand extends Command
{
    protected $signature = 'command:remind';

    protected $description = 'Daily check for user reminders.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $reminders = Reminder::whereRaw('notify_days = DATEDIFF(date, CURRENT_TIMESTAMP)')->get();
        foreach($reminders as $reminder){
            $user = $reminder->load('vehicle')->vehicle->user;
            $user->notify(new ReminderNotification($reminder));
            if($reminder->notify_email){
                $user->notify(new ReminderMailNotification($reminder));
            }
        }
        $this->info('Reminders sent successfully.');
    }
}
