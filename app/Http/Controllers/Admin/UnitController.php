<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use phpDocumentor\Reflection\Types\Parent_;
use Yajra\DataTables\Facades\DataTables;

class UnitController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Unit::query()->select(['id', 'name']);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.units.datatables.action') 
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.units.index');
}


    public function create(){
        
        return view('admin.units.create');


    }

    public function edit($id){

        $obj = Unit::find($id);
        return view('admin.units.edit',compact('obj'));


    }


     public function store(Request $request)
    {

        $request->validate([
            'name'  => 'required|string',
        ],[
            'name.required'=>'الإسم مطلوب',
        ]);

        // dd($request->all());
        $product =  parent::saveModel($request,Unit::class);
      
        if($request->id) return  redirect()->route('units.index')->with("success","تم التعديل بنجاح");


       return  redirect()->route('units.index')->with("success","تم الإنشاء بنجاح");

    }

    public function destroy($id)
    {
        $item = Unit::find($id);
        $item->delete();
        return true;
    }
}
