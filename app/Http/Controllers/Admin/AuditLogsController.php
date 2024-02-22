<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AuditLogExport;
use Gate;
use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class AuditLogsController extends Controller
{
    
    public function index(){
        abort_if(Gate::denies("audit_logs_access"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $auditlogs=AuditLog::all();
        return view('admin.auditlogs.index',compact('auditlogs'));
    }

    public function show($id)
    {
        abort_if(Gate::denies("audit_logs_show"), Response::HTTP_FORBIDDEN,"403 Forbidden");
        $auditlog = AuditLog::find($id);
        $login_dates = Carbon::parse($auditlog->created_at)->toDateString();
        $login_times = optional($auditlog->created_at)->format('h:i A');
        if($auditlog->log_out_time != null)
        {
            $logout_dates = Carbon::parse($auditlog->log_out_time)->format('Y-m-d');
            $logout_times = Carbon::parse($auditlog->log_out_time)->format('h:i A');
        }else
        {
            $logout_dates = "----";
            $logout_times = "----";
        }
        
            return response()->json([
                'auditlog' => $auditlog,
                'login_time' => $login_times,
                'login_date' => $login_dates,
                'logout_date' => $logout_dates,
                'logout_time' =>$logout_times,
            ]);
    }

    public function destroy($id)
    {
        abort_if(Gate::denies("audit_logs_delete"), Response::HTTP_FORBIDDEN,"403 Forbidden");

        $auditlog = AuditLog::find($id);
        $auditlog->delete();
        return redirect()->route('admin.audit_logs.index')->with('message' , 'User Log History Delete Successfully!');
    }

    public function exportCsv()
    {
        return Excel::download(new AuditLogExport, 'auditlogs.xlsx');
    }

}
