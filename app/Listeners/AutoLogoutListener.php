<?php

namespace App\Listeners;

use App\Events\AutoLogoutEvent;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AutoLogoutListener
{
    public function __construct()
    {
        //
    }

    public function handle(AutoLogoutEvent $event)
    {
        $userId = $event->userId;

        Log::info('AutoLogoutListener handle method called');
        Log::info('UserID: ' . $event->userId);
        Log::info('LoginID: ' . $event->loginId);
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
