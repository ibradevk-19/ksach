<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use phpDocumentor\Reflection\Types\Parent_;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Category::query()->select(['id', 'name']);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.categories.datatables.action') 
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.categories.index');
}


    public function create(){
        
        return view('admin.categories.create');


    }

    public function edit($id){

        $obj = Category::find($id);
        return view('admin.categories.edit',compact('obj'));


    }


     public function store(Request $request)
    {

        $request->validate([
            'name'  => 'required|string',
        ],[
            'name.required'=>'الإسم مطلوب',
        ]);

        // dd($request->all());
        $product =  parent::saveModel($request,Category::class);
      
        if($request->id) return  redirect()->route('categories.index')->with("success","تم التعديل بنجاح");


       return  redirect()->route('categories.index')->with("success","تم الإنشاء بنجاح");

    }

    public function destroy($id)
    {
        $item = Product::find($id);
        $item->delete();
        return true;
    }
}
