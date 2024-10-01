<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Actor;
use App\Models\Family;
use App\Models\WordFood;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\Types\Parent_;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Permission;

class ActorController extends Controller
{
    public function index(Request $request)
    {



        if ($request->ajax()) {
         $data = Actor::query()->with('flamily')->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'id_num' => $item->id_num,
                    'mobile_num' => $item->mobile_num,
                    'flamily_name' => $item->flamily->name,
                    'count' => WordFood::where('actor_id', $item->id)->count(),
                ];
            })->toArray();


            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.actors.datatables.action')
                ->rawColumns(['action'])
                ->make(true);
       }


        return view('admin.actors.index');
    }

    public function edit($id){

        if(checkPermission('view events')){

        $obj = Actor::findOrFail($id);
        $families = Family::all();

        return view('admin.actors.edit',compact('obj','families'));

        }
        return redirect()->route('no_Permission');
    }

    public function create()
    {
        return view('admin.actors.create')->with([
            'families' => Family::get(),
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'id_num' => 'required|integer',
            'mobile_num' => 'required',
            'family_id' => 'required|integer',
        ], [
            'name.required' => 'الإسم مطلوب',
            'id_num.required' => 'رقم الهوية مطلوب',
            'id_num.integer' => 'رقم الهوية يجب ان يكون رقم',
            'mobile_num.required' => 'رقم الجوال مطلوب',
            'family_id.required' => 'العائلة مطلوب',
            'family_id.integer' => 'يجب اختيار العائلة',
        ]);

        parent::saveModel($request, Actor::class);

        if ($request->id) return  redirect()->route('actors.index')->with("success", "تم التعديل بنجاح");


        return  redirect()->route('actors.index')->with("success", "تم الإنشاء بنجاح");
    }

}
