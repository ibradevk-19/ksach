<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\DeliveryRecordImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\DeliveryRecord;
use App\Models\DeliveryRecordBeneficial;
use App\Models\WordFood;
use App\Models\Product;
use App\Models\Actor;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\Snappy\Facades\SnappyPdf;

class DeliveryRecordController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = DeliveryRecord::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.delivery.datatables.action')
                ->addColumn('status', 'admin.delivery.datatables.status') 
                ->rawColumns(['action','status'])
                ->make(true);
        }
        return view('admin.delivery.index');
    }

    public function create() {
        return view('admin.delivery.create');
    }

    public function store(Request $request) {

        $request->validate([
            'start_date'  => 'required',
            'end_date'  => 'required',
            'name' => 'required',

        ],[
            'start_date.required'=>'الإسم مطلوب',
            'end_date.required'=>'الإسم مطلوب',
            'name.required'=>'الإسم مطلوب',
        ]);
        

        DeliveryRecord::create([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 1, // wating approvall
            'name' => $request->name,
        ]);

        return  redirect()->route('delivry.index')->with("success", "تم الإنشاء بنجاح");

    }
    
    public function importForm($delivry_id) {
        
        return view('delivery_import')->with([
            'delivry_id' => $delivry_id,
            'products' => Product::all(),
        ]);
    }

    public function import(Request $request) {
       
        $request->validate([
            'file' => 'required|file'
        ], [
            'file.required' => 'الرجاء رفع ملف',
            'file.mimes' => 'الرجاء التأكد من صيغة الملف (xls,xlsx)',
        ]);
        if($request->file->getClientOriginalExtension() != 'xlsx') return redirect()->back()->with(["error" => "الرجاء التأكد من صيغة الملف (xls,xlsx)"]) ;
        try{
                Excel::import(new DeliveryRecordImport($request->delivry_id,$request->product_id),$request->file);
                return redirect()->route('admin.import_res')->with(["success" => "تم جلب  البيانات  بنجاح"]);
            } catch (Exception $e) {
                return redirect()->route('admin.import_res')->with(["error" => "حدثت مشكلة في جلب البيانات"]);
            }   
    }


    public function indexRecord($delivry_id) {
        
        return view('admin.test.test')->with([
            'delivry_id' => $delivry_id
        ]);
        // if ($request->ajax()) {
            
        //     $data = DeliveryRecordBeneficial::where('delivery_record_id',$delivry_id)->with('beneficial', 'beneficial.flamily','beneficial.actor','product','product.provider')->get();
            
        //     return Datatables::of($data)
        //         ->addIndexColumn()
        //         ->addColumn('id_num', function ($row)  {
        //             return $row->beneficial->id_num ?? '-';
        //         })
        //         ->addColumn('full_name', function ($row)  {
        //             return $row->beneficial->full_name ?? '-';
        //         })
        //         ->addColumn('wife_name', function ($row)  {
        //             return $row->beneficial->wife_name ?? '-';
        //         })
        //         ->addColumn('wife_id_num', function ($row)  {
        //             return $row->beneficial->wife_id_num ?? '-';
        //         })
        //         ->addColumn('family_count', function ($row)  {
        //             return $row->beneficial->family_count ?? '-';
        //         })
        //         ->addColumn('marital_status', function ($row)  {
        //             return $row->beneficial->marital_status ?? '-';
        //         })
        //         ->addColumn('mobile', function ($row)  {
        //             return $row->beneficial->mobile ?? '-';
        //         })
        //         ->addColumn('flamily_name', function ($row)  {
        //             return $row->beneficial?->flamily->name ?? '-';
        //         })
        //         ->addColumn('actor_name', function ($row)  {
        //             return $row->beneficial?->actor?->name ?? '-';
        //         })
        //         ->addColumn('product', function ($row)  {
        //             return $row->product?->name . ' -' . $row->product?->provider->name  ?? '-' ;
        //         })
        //         ->addColumn('checkbox', function($row){
        //             return '<input type="checkbox" name="user_checkbox[]" class="user_checkbox" value="'.$row->id.'" />';
        //         })
        //         ->addColumn('action', 'admin.delivry-record.datatables.action')
        //         ->addColumn('status', 'admin.delivry-record.datatables.status') 
        //         ->rawColumns(['action','status','checkbox'])
        //         ->make(true);
        // }

        // return view('admin.delivry-record.index')->with([
        //     'delivry_id' => $delivry_id
        // ]);
    }


    
    
    public function approval(Request $request,$id,$beneficial_id) {
        $user = DeliveryRecordBeneficial::where('id',$id)->where('beneficial_id',$beneficial_id)->first();

        $user->update([
            'status' => 2,
        ]);

        WordFood::where('id',$beneficial_id)->first()->update([
            'status' => 2,
        ]);

        return  redirect()->route('delivry.index-record',['delivry_id'=> $id])->with("success", "تم الموافقة بنجاح");
    }


    public function approvalAll(Request $request,$delivery_record_id) {
        $users = DeliveryRecordBeneficial::where('delivery_record_id',$delivery_record_id)->get();
        
         foreach($users as $user){
            $user->update([
                'status' => 2,
            ]);

            WordFood::where('id',$user->beneficial_id)->first()->update([
                'status' => 2,
            ]);
         }

        return  redirect()->route('delivry.index-record',['delivry_id'=> $delivery_record_id])->with("success", "تم الموافقة بنجاح");
    }

    public function print($delivry_id) {

        $data = DeliveryRecordBeneficial::where('delivery_record_id',$delivry_id)->where('status',2)->with('beneficial', 'beneficial.flamily','beneficial.actor','product','product.provider')->get();

        $pdf = SnappyPdf::loadView('pdf.delivry-record', [
            'data' => $data,
        ])
        ->setPaper('a4')
        ->setOption('margin-top', 10)
        ->setOption('margin-left', 10)
        ->setOption('margin-right', 10)
        ->setOption('margin-bottom', 10);

        return $pdf->download('delivry-record.pdf');
    }


    public function printActor($delivry_id) {
        return view('admin.delivery.actor')->with([
            'delivry_id' => $delivry_id,
            'actors' => Actor::all()
        ]);
    }
    public function printActorAction(Request $request) {
        $ids =  WordFood::select('id')->where('actor_id',$request->actor_id)->get()->toArray();
        $data = DeliveryRecordBeneficial::with('beneficial', 'beneficial.flamily','beneficial.actor','product','product.provider')->whereIn('beneficial_id',$ids)->get();
        
        $actor = Actor::find($request->actor_id);
        $pdf = SnappyPdf::loadView('pdf.actor-delivry-record', [
            'data' => $data,
            'actor' => $actor,
             'count' => count($data)
        ])
        ->setPaper('a4')
        ->setOption('margin-top', 10)
        ->setOption('margin-left', 10)
        ->setOption('margin-right', 10)
        ->setOption('margin-bottom', 10);
        $file_name = $actor->name . '.pdf';

        $users = DeliveryRecordBeneficial::whereIn('beneficial_id',$ids)->get();
       foreach($users as $user){
            $user->update([
                'status' => 2,
            ]);

            WordFood::where('id',$user->beneficial_id)->first()->update([
                'status' => 2,
            ]);
       }
        return $pdf->download($file_name);
    }
    

    
   
}
