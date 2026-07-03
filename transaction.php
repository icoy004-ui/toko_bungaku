<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    //
    protected $fillable = ['n0_nota', 'jtotal_harga'];
    public function detail(){
        return $this->hasMany(transaction_detail::class,'transaction_id');
    }

}
