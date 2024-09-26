<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\TaxExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BeneficialCheckerImport;
use App\Models\ImportExcelResulte;

class BeneficialController extends Controller
{
    public function create(Request $request) {
        return view('beneficial.import');
    }


    public function checker(Request $request) {
        $request->validate([
            'file' => 'required|file'
        ], [
            'file.required' => 'الرجاء رفع ملف',
            'file.mimes' => 'الرجاء التأكد من صيغة الملف (xls,xlsx)',

        ]);


        if($request->file->getClientOriginalExtension() != 'xlsx') return redirect()->back()->with(["error" => "الرجاء التأكد من صيغة الملف (xls,xlsx)"]) ;

        // Excel::import(new UsersImport, request()->file('your_file'));
        try{
                Excel::import(new BeneficialCheckerImport,$request->file);
                $data =  ImportExcelResulte::get();
                $file_name = $request->file->getClientOriginalName();
                return Excel::download(new TaxExport($data), $file_name);
                //return redirect()->route('checker.create')->with(["success" => "تم جلب  البيانات  بنجاح"]);
            } catch (Exception $e) {
                return redirect()->route('checker.create')->with(["error" => "حدثت مشكلة في جلب البيانات"]);
            }  
    }
}
