<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    
  


    protected $fillable = [
        'type',
        'provider_id',
        'date',
        'receiver_id',   // present receiver model family or actors 
        'receiver_type',  // 1 == flamily and 2 == actor  3 == og_name
        'admin_id',
        'port_name',
        'status',
        'unit_id',
        'category_id',
        'og_name'  
    ];


    public function flamily() {
        return $this->belongsTo(Family::class,'receiver_id');
     }

     public function beneficial() {
        return $this->belongsTo(WordFood::class,'receiver_id');
     }

     public function actor() {
        return $this->belongsTo(Actor::class,'receiver_id');
     }

     public function invoice_items() {
        return $this->hasOne(InvoiceItem::class,'invoice_id');
     }

     public function items()
     {
         return $this->hasMany(InvoiceItem::class, 'invoice_id');
     }

     public function provider() {
      return $this->belongsTo(Provider::class,'provider_id');
    }

    public function unit() {
        return $this->belongsTo(Unit::class,'unit_id');
    }

    public function category() {
        return $this->belongsTo(Category::class,'category_id');
    }

    // Accessor for Receiver Name
    public function getReceiverNameAttribute()
    {
        switch ($this->receiver_type) {
            case 1:
                return $this->actor ? $this->actor->name : 'Unknown Actor';
            case 2:
                return $this->beneficial ? $this->beneficial->full_name : 'Unknown Family';
            case 3:
                return $this->og_name ? $this->og_name : 'No OG Name';
            default:
                return 'المركز السعودي';
        }
    }
  
    public function getPortNameAttribute($value)
    {
        switch ($value) {
            case 1: 
                return  'معبر رفح';
            case 2:
                return  'معبر كرم ابوسالم';
            case 3:
                return  'معبر ايرز';
            default:
                return  'المركز السعودي';
        }
    }

    public function getTypeAttribute($value)
    {
        switch ($value) {
            case 'out': 
                return  'صادر';
            case 'in':
                return  'وارد';
            case 'damaged':
                return  'تالف';
            default:
                return  'المركز السعودي';
        }
    }

    public static function csvExport($providerId, $productId)
    {
        $invoices = static::filteredExport($providerId, $productId);

        $output = "ID,Provider,Products,Date,Total\n";

        foreach ($invoices as $invoice) {
            $products = $invoice->items->map(function ($item) {
                return $item->product->name . " (" . $item->quantity . ")";
            })->join(', ');

            $output .= "{$invoice->id},{$invoice->provider->name},{$products},{$invoice->created_at->format('Y-m-d')},{$invoice->total}\n";
        }

        return $output;
    }

    public static function filteredExport($providerId, $productId)
    {
        $query = Invoice::query()->with('provider', 'items');

        if (!empty($providerId)) {
            $query->where('provider_id', $providerId);
        }

        if (!empty($productId)) {
            $query->whereHas('items', function ($q) use ($productId) {
                $q->where('product_id', $productId);
            });
        }

        return $query->get();
    }
}
