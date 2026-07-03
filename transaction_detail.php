<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaction_detail extends Model
{
    //
    protected $fillable = [
        'transaction_id', 
        'product_id', 
        'qty', 
        'harga_satuan', 
        'subtotal'
    ];

    //hubungan dengan model transaction
    public function transaction(){
        return $this->belongsTo(transaction::class, 'transaction_id'); 
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id'); 
    }

}
