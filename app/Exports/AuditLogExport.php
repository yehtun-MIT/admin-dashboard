<?php

namespace App\Exports;

use App\Models\AuditLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AuditLogExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return AuditLog::all();
    }

    public function headings(): array
    {
        return ["id","user Id", "Name","Email","Logout Time","Login Time"];
    }
}
