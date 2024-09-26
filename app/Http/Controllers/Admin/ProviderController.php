<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;
use phpDocumentor\Reflection\Types\Parent_;
use Yajra\DataTables\Facades\DataTables;

class ProviderController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Provider::query()->select(['id', 'name']);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.providers.datatables.action') 
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.providers.index');
}


    public function create(){
        
        return view('admin.providers.create');


    }

    public function edit($id){

        $obj = Provider::find($id);
        return view('admin.providers.edit',compact('obj'));


    }


     public function store(Request $request)
    {

        $request->validate([
            'name'  => 'required|string',
        ],[
            'name.required'=>'الإسم مطلوب',
        ]);

        // dd($request->all());
        $product =  parent::saveModel($request,Provider::class);
      
        if($request->id) return  redirect()->route('providers.index')->with("success","تم التعديل بنجاح");


       return  redirect()->route('providers.index')->with("success","تم الإنشاء بنجاح");

    }

    public function destroy($id)
    {
        $item = Provider::find($id);
        $item->delete();
        return true;
    }
}
