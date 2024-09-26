<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Family;
use App\Models\Actor;
use App\Models\Category;
use App\Models\Provider;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\Models\Unit;
use App\Models\WordFood;
use Illuminate\Support\Str;
use Barryvdh\Snappy\Facades\SnappyPdf;

class InvoiceController extends Controller
{
    
    public function index(Request $request){
        return view('admin.invoices.new-index');

       if ($request->ajax()) {
         
          $data = Invoice::query()->with(['provider','unit','invoice_items','category'])->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($data) use ($request) {
                
                })
                ->addColumn('unit', function ($row)  {
                    return $row->unit->name ?? '-';
                })
                ->addColumn('product', function ($row)  {
                    return $row->invoice_items->product->name ;
                })
                ->addColumn('category', function ($row)  {
                    return $row->category->name;
                })
                ->addColumn('type', function ($row)  {
                    if($row->type == 'out'){
                         return 'صادر';
                    }else{
                       return "وارد";
                    }
                })
                ->addColumn('provider_name', function ($row)  {
                    if($row->type == 'out'){
                         return 'المركز السعودي';
                    }else{
                       return $row->provider->name;
                    }
                })
                ->addColumn('receiver_name', function ($row)  {
                    if($row->type == 'out'){
                        if($row->receiver_type == 1){
                            return Actor::where('id',$row->receiver_id)->first()->name;
                        }elseif($row->receiver_type == 2 ){
                            return WordFood::where('id',$row->receiver_id)->first()->full_name;
                        }elseif($row->receiver_type == 3 ){
                            return $row->og_name;
                        }
                    }else{
                       return 'المركز السعودي';
                    }
                     
                })
                ->addColumn('port_name', function ($row)  {
                    if($row->port_name == '1'){
                        return ' معبر رفح';
                    }

                    if($row->port_name == '2'){
                        return 'معبر كرم ابوسالم';
                    }

                    if($row->port_name == '3'){
                        return ' معبر ايرز';
                    }
                })
                ->addColumn('quantity', function ($row)  {
                       return $row->invoice_items->quantity;                  
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.invoices.index');
}


public function createNew(){
    return view('admin.invoices.create-new');
}

public function newIndex(){
    return view('admin.invoices.new-index');
}

    public function create(){
        return view('admin.invoices.create-new');

        $providers = Provider::all();
        $categories = Category::all();
        $units = Unit::all();
        $products = Product::with('provider')->get();

        return view('admin.invoices.create')->with([
            'providers' => $providers,
            'categories' => $categories,
            'units' => $units,
            'products' => $products,
        ]);


    }

    public function store(Request $request){
        $request->validate([
            'product_id'  => 'required|integer',
            'provider_id'  => 'required|integer',
            'quantity' => 'required|integer',
            'unit_id' => 'required|integer',
            'category_id' => 'required|integer',
            'port_name' => 'required|integer'
        ],[
            'product_id.required'=>'المنتج مطلوب',
            'unit_id.required'=>'الوحدة مطلوب',
            'category_id.required'=>'التصنيف مطلوب',
            'provider_id.required'=>'المورد مطلوب',
            'provider_id.integer'=>'يجب اختيار المورد ',
            'quantity.required'=>'الكمية يجب ان تكون رقم صحيح',
            'quantity.integer'=>'الكمية يجب ان تكون رقم صحيح',
            'unit_id.integer'=>' يجب اختيار الوحدة ',
            'category_id.integer'=>' يجب اختيار التصنيف ',
            'port_name.required'=>'المنفذ مطلوب',
            'port_name.integer'=>' يجب اختيار المنفذ ',


        ]);

        
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
            'product_id' => $request->product_id,
            'invoice_id' => $invoice->id,
            'quantity' => $request->quantity,
            'date' => Carbon::now(),
            'unit_id' => $request->unit_id,
            'category_id' => $request->category_id,
        ]);

        $product = Product::where('id',$request->product_id)->first();
        if($product){
            $product->update([
                'quantity' => $request->quantity + $product->quantity
            ]);
        }

        return  redirect()->route('invoices.index')->with("success", "تم الإنشاء بنجاح");

    }

    public function storeExportCreate(Request $request)  {
        $providers = Provider::all();
        $categories = Category::all();
        $units = Unit::all();
        $products = Product::with('provider')->where('quantity','>',0)->get();
        $beneficiaries = WordFood::all();
        $actors = Actor::all();

        return view('admin.invoices.export_create')->with([
            'providers' => $providers,
            'categories' => $categories,
            'units' => $units,
            'products' => $products,
            'beneficiaries' => $beneficiaries,
            'actors' => $actors,
        ]);
    }

    public function storeExport(Request $request)  {

        
        $request->validate([
            'product_id'  => 'required|integer',
            'quantity' => 'required',
            'unit_id' => 'required|integer',
        ],[
            'product_id.required'=>'المنتج مطلوب',
            'unit_id.required'=>'الوحدة مطلوب',
            'quantity.required'=>'الكمية يجب ان تكون رقم صحيح',
            'unit_id.integer'=>' يجب اختيار الوحدة ',
        ]);
        
        $product = Product::find($request->product_id);

        if($product->quantity < $request->quantity){
            return redirect()->back()->with(['error'=>"الكمية غير متوفرة في المخزن"]);
        }

        if($request->receiver_type == 1){
           $request['receiver_id'] = $request->actor_id;
        }
        if($request->receiver_type == 2){
            $request['receiver_id'] = $request->beneficiaries_id;
        }
        if($request->receiver_type == 3){
            $request['receiver_id']  = null;
            
        }
      
        $invoice = Invoice::create([
            'type' => 'out',
            'provider_id' => $product->provider_id,
            'date' =>  Carbon::now(),
            'receiver_id' => $request->receiver_id,
            'receiver_type' => $request->receiver_type,
            'admin_id' => auth('admin')->user()->id,
            'port_name' => null,
            'status' => 1,
            'unit_id' =>  $product->unit_id,
            'category_id' =>  $product->category_id,
            'og_name' => $request->receiver_type = 3 ? $request->og_name : '' ,
        ]);

        InvoiceItem::create([
            'product_id' => $request->product_id,
            'invoice_id' => $invoice->id,
            'quantity' => $request->quantity,
            'date' => Carbon::now(),
            'unit_id' => $product->unit_id,
            'category_id' => $product->category_id,
        ]);

        $product = Product::where('id',$request->product_id)->first();
        if($product){
            $product->update([
                'quantity' =>  $product->quantity - $request->quantity,
            ]);
        }

        return  redirect()->route('invoices.index')->with("success", "تم الإنشاء بنجاح");
    }

    public function pdf() {
        $invoices = Invoice::query()->with(['provider','unit','invoice_items','category'])->get();
        $products = Product::where('provider_id',4)->with(['provider','unit','category'])->get();
        $data = [];

        foreach($invoices as $key => $invoice){
            $data[$key]['id'] = $invoice->id;
            $data[$key]['quantity'] = $invoice->invoice_items->quantity;
            if($invoice->port_name == '1'){
                $data[$key]['port_name'] = ' معبر رفح';
            }

            if($invoice->port_name == '2'){
                $data[$key]['port_name'] = 'معبر كرم ابوسالم';
            }

            if($invoice->port_name == '3'){
                $data[$key]['port_name'] = ' معبر ايرز';
            }
            if($invoice->port_name == '0'){
                $data[$key]['port_name'] = 'المركز السعودي';
            }

            if($invoice->type == 'out'){
                if($invoice->receiver_type == 1){
                    $data[$key]['receiver_name']  = Actor::where('id',$invoice->receiver_id)->first()->name;
                }elseif($invoice->receiver_type == 2 ){
                    $data[$key]['receiver_name']  = WordFood::where('id',$invoice->receiver_id)->first()->full_name;
                }elseif($invoice->receiver_type == 3 ){
                    $data[$key]['receiver_name']  = $invoice->og_name;
                }
            }else{
                $data[$key]['receiver_name']  = 'المركز السعودي';
            }
            if($invoice->type == 'out'){
                $data[$key]['provider_name']  = 'المركز السعودي';
            }else{
                $data[$key]['provider_name']  = $invoice->provider->name;
            }
            if($invoice->type == 'out'){
                $data[$key]['type'] = 'صادر';
            }else{
              $data[$key]['type'] = "وارد";
            }
            $data[$key]['category'] = $invoice->category->name;
           
            $data[$key]['unit'] = $invoice->unit->name ?? '-';
            $data[$key]['product'] = $invoice->invoice_items->product->name ;
            $data[$key]['date'] = $invoice->date ;
            
        }


        $pdf = SnappyPdf::loadView('pdf.invoices', [
            'invoices' => $data,
            'products' => $products,
        ])
        ->setPaper('a4')
        ->setOption('margin-top', 10)
        ->setOption('margin-left', 10)
        ->setOption('margin-right', 10)
        ->setOption('margin-bottom', 10);

        return $pdf->download('invoices.pdf');
    }
    
   
    
}
