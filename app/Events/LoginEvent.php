<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LoginEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $username;
    public $email;
    public $loginId;
    
    public function __construct($userId ,$username , $email ,$loginId)
    {
        $this->username = $username;
        $this->email = $email;
        $this->userId = $userId;
        $this->loginId = $loginId;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
