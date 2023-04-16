<?php

namespace App\Http\Controllers;

use App\Exports\ExportUsers;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportExportController extends Controller
{
    public function export() 
    {
        return Excel::download(new ExportUsers, 'karyawan.xlsx');
    }
}
