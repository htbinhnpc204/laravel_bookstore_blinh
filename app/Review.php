<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $table = 'reviews';
    protected $fillable = [
        'rating', 'comment'
    ];

    public function detail(){
        return $this->belongsTo(OrderDetails::class);
    }
}
