<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\Provider;
use App\Models\Category;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\Models\Unit;

class ProductController extends Controller
{
    public function index(Request $request){
            if ($request->ajax()) {
                $data = Product::query()->with('provider','unit')->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('provider_name', function ($row)  {
                        return $row->provider->name;
                    })
                    ->addColumn('unit_name', function ($row)  {
                        return $row->unit->name;
                    })
                    ->addColumn('action', 'admin.products.datatables.action') 
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('admin.products.index');
    }
    
    
        public function create(){
            $providers = Provider::all();
            $categories = Category::all();
            $units = Unit::all();

            
            return view('admin.products.create')->with([
                'providers' => $providers,
                'categories'  => $categories,
                'units' => $units,
            ]);
    
    
        }
    
        public function edit($id){
    
            $obj = Product::find($id);
            $providers = Provider::all();
            $categories = Category::all();
            return view('admin.products.edit',compact('obj','providers','categories'));
    
    
        }
    
    
         public function store(Request $request)
        {
    
            $request->validate([
                'name'  => 'required|string',
                'provider_id'  => 'required|integer',
                'quantity' => 'required',
                'unit_id' => 'required|integer',
                'category_id' => 'required|integer',
            ],[
                'name.required'=>'الإسم مطلوب',
                'unit_id.required'=>'الوحدة مطلوب',
                'category_id.required'=>'التصنيف مطلوب',
                'provider_id.required'=>'المورد مطلوب',
                'provider_id.integer'=>'يجب اختيار المورد ',
                'quantity.required'=>'الكمية يجب ان تكون رقم صحيح',
                'unit_id.integer'=>' يجب اختيار الوحدة ',
                'category_id.integer'=>' يجب اختيار التصنيف ',

            ]);
    
            // dd($request->all());
           
            $product =  Product::create([
                'name' => $request->name,
                'provider_id' => $request->provider_id,
                'quantity' => $request->quantity,
                'unit_id' => $request->unit_id,
                'category_id' => $request->category_id,
            ]);
        //    $product =  parent::saveModel($data,Product::class);
           $invoice = Invoice::create([
                'type' => 'in',
                'provider_id' => $request->provider_id,
                'date' =>  Carbon::now(),
                'receiver_id' => 0,
                'receiver_type' => 0,
                'admin_id' => auth('admin')->user()->id,
                'port_name' => $request->port_name,
                'status' => 1,
                'unit_id' => $request->unit_id,
                'category_id' => $request->category_id,
            ]);
            InvoiceItem::create([
                'product_id' => $product->id,
                'invoice_id' => $invoice->id,
                'quantity' => $product->quantity,
                'date' => Carbon::now(),
                'unit_id' => $request->unit_id,
                'category_id' => $request->category_id,
            ]);
            if($request->id) return  redirect()->route('products.index')->with("success","تم التعديل بنجاح");
    
    
           return  redirect()->route('products.index')->with("success","تم الإنشاء بنجاح");
    
        }
    
        public function destroy($id)
        {
            $item = Product::find($id);
            $item->delete();
            return true;
        }
    
}
