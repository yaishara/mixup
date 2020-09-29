<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable=[
        'category_id',
        'name',
    ];
    public function category(){
        return $this->belongsTo(category::class);
    }
}
