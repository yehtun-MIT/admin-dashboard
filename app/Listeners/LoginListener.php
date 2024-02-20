<?php

namespace App\Listeners;

use App\Events\LoginEvent;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Session;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class LoginListener
{
    protected $login_id;

    public function __construct()
    {
        //
    }

    public function handle(LoginEvent $event)
    {
        $serverTime = Carbon::now(); // Server time
        $localTime = $serverTime->tz('Asia/Yangon'); // Convert to Myanmar (Yangon) time

        $userId = $event->userId;
        $username = $event->username;
        $email = $event->email;

        $login_id = DB::table('login_history')->insertGetId([
            'user_id' => $userId,
            'name' => $username,
            'email' => $email,
            'created_at' => $localTime->toDateTimeLocalString(),
            'updated_at' => $localTime->toDateTimeLocalString(),
        ]);
        $event->loginId = $login_id;
        session(['loginId' => $event->loginId]);
    }

}

