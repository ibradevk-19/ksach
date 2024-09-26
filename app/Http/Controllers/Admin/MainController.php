<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WordFood;
use App\Models\Family;
use App\Models\Actor;
use App\Models\DeliveryRecordBeneficial;
use phpDocumentor\Reflection\Types\Parent_;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Cache;

class MainController extends Controller
{
    public function index(Request $request)  
    {
        // Cache the query that fetches WordFood with related flamily and actor when not using AJAX
        // $query = Cache::remember('wordfood_list', 60, function() {
        //     return WordFood::query()->where('status', 2)->with('flamily', 'actor')->get();
        // });
        $pageSize = ($request->length) ? $request->length : 10;
        if ($request->ajax()) {
    
            // Cache the data used in DataTables for 60 minutes
            $data =  WordFood::query()->with('flamily', 'actor');
      
            $itemCounter = $data->get();
            $count_total = $itemCounter->count();
            $count_filter = 0;

            $start = ($request->start) ? $request->start : 0;

            $data->skip($start)->take($pageSize);
            $items = $data->get();

            $count_filter = count($items);
            
            return Datatables::of($data)
                ->addIndexColumn()
                ->with([
                    "recordsTotal" => $count_total,
                    "recordsFiltered" => $count_total,
                 ])
                ->addColumn('flamily_name', function ($row)  {
                    return $row->flamily->name ?? '-';
                })
                ->addColumn('actor_name', function ($row)  {
                    return $row->actor->name ?? '-';
                })
                ->addColumn('action', 'admin.main.datatables.action')
                ->rawColumns(['action','flamily_name','actor_name'])
                ->make(true);
        }
    
        return view('admin.main.index');
    }

    public function create()
    {
        $families = Family::all();
        $actors = Actor::all();

        return view('admin.main.create', compact('families','actors'));
    }
    public function edit($id)
    {
        $obj = WordFood::find($id);
        $families = Family::all();
        $actors = Actor::all();
        return view('admin.main.edit', compact('obj','families','actors'));

    }
    

    public function store(Request $request) {
        $request->validate([
            'full_name'  => 'required|string',
            'id_num'  => 'required|integer',
            'wife_name'  => 'required|string',
            'wife_id_num'  => 'required|integer',
            'family_count'  => 'required',
            'marital_status'  => 'required|integer',
            'mobile'  => 'required|integer',
        ], [
            'full_name.required' => 'حقل الاسم مطلوب',
            'id_num.required' => 'حقل رقم الهوية مطلوب',
            'wife_name.required' => 'حقل اسم الزوجة مطلوب',
            'wife_id_num.required' => 'حقل رقم هوية الزوجة مطلوب',
            'family_count.required' => 'حقل عدد الافراد مطلوب',
            'marital_status.required' => 'حقل الحالة الاجتماعية مطلوب',
            'mobile.required' => 'حقل رقم الجوال مطلوب',
            'full_name.string' => 'حقل اسم الزوج يجب ان يكون نص',
            'wife_name.string' => 'حقل اسم الزوجة يجب ان يكون نص',
            'id_num.integer' => 'حقل رقم هوية الزوج يجب ان يكون رقم',
            'wife_id_num.integer' => 'حقل رقم هوية الزوجة يجب ان يكون رقم',
            'mobile.integer' => 'حقل رقم الجوال يجب ان يكون رقم',
            'marital_status.integer' => 'حقل الحالة الاجتماعية فارغ',
        ]);

        $user = WordFood::find($request->id);

        $chek_if_user_exest = WordFood::where('id_num', $request->id_num)->first();
         if($chek_if_user_exest && !$request->id){
            return  redirect()->route('admin.main.index')->with("error", "الاسم مدرج سابقا في الكشوفات");
         }

         if($chek_if_user_exest && $request->id && $user->id_num != $request->id_num){
            return  redirect()->route('admin.main.index')->with("error", "الاسم مدرج سابقا في الكشوفات");
         }

        parent::saveModel($request, WordFood::class);

        if ($request->id) return  redirect()->route('admin.main.index')->with("success", "تم التعديل بنجاح");


        return  redirect()->route('admin.main.index')->with("success", "تم الإنشاء بنجاح");
    }

    public function destroy($id)
    {
        $item = WordFood::find($id);
        $item->delete();
        return true;
    }

    public function details($id)
    {
        $obj = WordFood::find($id);
        $data = DeliveryRecordBeneficial::where('beneficial_id',$obj->id)->get();


        if ($request->ajax()) {

            $data = $data;

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('flamily_name', function ($row)  {
                    return $row->flamily->name;
                })
                ->addColumn('actor_name', function ($row)  {
                    return $row->actor->name ?? '-';
                })
                ->addColumn('action', 'admin.main.datatables.action')
                ->rawColumns(['action','flamily_name','actor_name'])
                ->make(true);
         }

        return view('admin.main.details', compact('obj','data'));

    }
    

}
