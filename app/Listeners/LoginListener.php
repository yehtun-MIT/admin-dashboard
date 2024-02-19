<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class LoginListener
{
    protected $login_id;

    public function __construct()
    {
        //
    }

    public function handle($event)
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

        $this->login_id = $login_id;
    }

    // public function logout($event){
    //     $userId = $event->userId;
    //     // Log logout time
    //     $serverTime = Carbon::now();
    //     $localTime = $serverTime->tz('Asia/Yangon');

    //     DB::table('login_history')
    //         ->where('id', $this->login_id) // use the login_id obtained during login
    //         ->whereNull('log_out_time') // Update only if log_out is null
    //         ->update([
    //             'log_out_time' => $localTime->toDateTimeLocalString(),
    //             'updated_at' => $localTime->toDateTimeLocalString(),
    //         ]);
    // }
}

