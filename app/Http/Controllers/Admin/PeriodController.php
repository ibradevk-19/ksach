<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Provider::query();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.periods.datatables.action') 
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.periods.index');
    }
}
