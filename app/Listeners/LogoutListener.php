<?php

namespace App\Listeners;

use App\Events\LogoutEvent;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class LogoutListener
{
    public function __construct()
    {
        //
    }

    public function handle(LogoutEvent $event)
    {
        $userId = $event->userId;

        // Log logout time
        $serverTime = Carbon::now();
        $localTime = $serverTime->tz('Asia/Yangon');

        DB::table('login_history')
            ->where('id', $event->loginId)
            ->whereNull('log_out_time') 
            ->update([
                'log_out_time' => $localTime->toDateTimeLocalString(),
                'updated_at' => $localTime->toDateTimeLocalString(),
            ]);

        session()->forget('loginId');
    }
}
