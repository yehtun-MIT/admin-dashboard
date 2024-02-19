<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogsController extends Controller
{
    public function index(){
        $auditlogs=AuditLog::all();
       
        return view('admin.auditlogs.index',compact('auditlogs'));
    }
}
