<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $primaryKey = 'brand_id';
    public $timestamps = false;
    protected $fillable = ['brand_name', 'category_id'];

     public function category(){
        return $this->belongsTo('App\Models\Category','category_id' );
      }

       public function items(){
        return $this->hasMany('App\Models\Item','brand_id' );
      }
}
