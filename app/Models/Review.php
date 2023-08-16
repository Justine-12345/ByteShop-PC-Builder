<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
       protected $primaryKey = "review_id";
   public $timestamps = false;
    protected $fillable = ['review_content', 'review_rating','review_date','item_id', 'user_id'];

    public function item(){
        return $this->belongsTo(Item::class, 'item_id');
    }

     public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
