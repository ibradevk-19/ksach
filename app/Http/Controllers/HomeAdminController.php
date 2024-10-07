<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Imports\MainImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ImportExcelResulte;
use App\Models\WordFood;
use App\Models\Family;
use App\Models\Actor;
use App\Models\Admin;
use App\Exports\TaxExport;




class HomeAdminController extends Controller
{

    public function home(Request $request){




        if ($request->ajax()) {
            if(checkPermission('view beneficial')){

                $data = User::query()->select(['id', 'global_id', 'email','phone','first_name','last_name','score'])->where('global_id','!=',1569539)->orderBy('score','desc')->paginate(20)->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'email' => $item->email,
                        'mobile' => $item->phone,
                    ];
                })->toArray();

                return Datatables::of($data)
                ->addColumn('phone', 'admin.rooms.episodes.winners.datatables.phone')
                    ->addIndexColumn()

                    // ->addColumn('action', 'admin.members.datatables.actions')
                    ->rawColumns(['phone'])
                    ->make(true);
            }
        }



        $users_count = WordFood::count();
        $rooms_count = Family::count();
        $sponsor_count = Actor::count();
        $admins_count = Admin::count();

        return view('index',compact('users_count','rooms_count','admins_count','sponsor_count'));

    }

    public function import() {
        return view('import');
    }


    public function importNewIds(Request $request) {

            $request->validate([
                'file' => 'required|file'
            ], [
                'file.required' => 'الرجاء رفع ملف',
                'file.mimes' => 'الرجاء التأكد من صيغة الملف (xls,xlsx)',

            ]);


            if($request->file->getClientOriginalExtension() != 'xlsx') return redirect()->back()->with(["error" => "الرجاء التأكد من صيغة الملف (xls,xlsx)"]) ;

            // Excel::import(new UsersImport, request()->file('your_file'));
            try{
                    Excel::import(new MainImport,$request->file);
                    return redirect()->route('admin.import_res')->with(["success" => "تم جلب  البيانات  بنجاح"]);
                } catch (Exception $e) {
                    return redirect()->route('admin.import_res')->with(["error" => "حدثت مشكلة في جلب البيانات"]);
                }
    }


    public function importRes(Request $request) {
        if ($request->ajax()) {

            $data = ImportExcelResulte::query()->get()->toArray();

            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
       }

        return view('import_res');
    }

    public function export(Request $request)  {

            $data = WordFood::all();

            if ($request->export == 'pdf') {
                $pdf = SnappyPdf::loadView('pdf.taxes', [
                    'taxes'=> $taxes,
                ])
                ->setPaper('a4')
                ->setOption('margin-top', 0)
                ->setOption('margin-left', 10)
                ->setOption('margin-right', 10)
                ->setOption('margin-bottom', 0);

                return $pdf->download('all.pdf');
            }

            return Excel::download(new TaxExport($data), 'all.xlsx');

    }

    public function checkIdNumber($id)  {
        return $id;
    }

    public function testHome()  {
        return view('admin.test.test');
    }

    public function excelCheck()  {
        return view('admin.test.check'); //sddd
    }

    public function showForm()  {
        return view('admin.test.form');
    }

}
