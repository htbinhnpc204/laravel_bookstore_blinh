<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
    //
    protected $fillable = ['id','name','giaban','soluong','cd_id','tacgia',
        'nxb','gioithieu','hinhanh','taiban'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function order_details(){
        return $this->belongsTo(OrderDetails::class);
    }
}
