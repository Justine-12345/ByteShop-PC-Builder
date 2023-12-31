<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

       protected $primaryKey = "item_id";

    protected $fillable = ['quantity', 'item_id'];
    public $timestamps = false;
    public function item(){
        return $this->belongsTo('App\Models\Item', 'item_id');
    } 
}
