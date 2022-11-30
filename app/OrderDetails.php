<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    //
    protected $fillable = [
        'order_id', 'book_id', 'quantity'];
    public function book(){
        return $this->belongsTo(Book::class);
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function reviews(){
        return $this->hasOne(Review::class);
    }
}
