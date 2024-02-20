<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

   public  $dates = [
    'log_out_time',
    'created_at',
    'update_at'
   ];
    public $table='login_history';

    protected $fillabel=['user_id', 'name', 'email', 'log_out_time'];
}
