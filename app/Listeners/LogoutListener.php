<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class LogoutListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handle($event)
    {
        $userId = $event->userId;

        // Log logout time
        $serverTime = Carbon::now();
        $localTime = $serverTime->tz('Asia/Yangon');

        DB::table('login_history')
            ->where('user_id', $userId)
            ->whereNull('log_out_time') // Update only if log_out is null
            ->update([
                'log_out_time' => $localTime->toDateTimeLocalString(),
                'updated_at' => $localTime->toDateTimeLocalString(),
            ]);
    }
}
