<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Family;
use phpDocumentor\Reflection\Types\Parent_;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Permission;

class FamilyController extends Controller
{
    public function index(Request $request)
    {



        if ($request->ajax()) {
            $data = Family::query()->select(['id', 'name', 'code'])->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'code' => $item->code,
                ];
            })->toArray();


            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }


        return view('admin.family.index');
    }


    public function create()
    {
        return view('admin.family.create');
    }

    public function edit($id)
    {

        $obj = Family::find($id);

        return view('admin.family.edit', compact('obj'));
    }


    public function store(Request $request)
    {
     

        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'الإسم مطلوب',
        ]);
        $request->code = 1;
        $latest = Family::latest()->limit(1)->first();
        if($latest){
            $request['code'] = 'fa-' . $latest->id + 1;
        }else{
            $request['code'] = 'fa-' . 1;
        }

       
       
        parent::saveModel($request, Family::class);

        if ($request->id) return  redirect()->route('families.index')->with("success", "تم التعديل بنجاح");


        return  redirect()->route('families.index')->with("success", "تم الإنشاء بنجاح");
    }

}
