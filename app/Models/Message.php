<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $primaryKey = 'message_id';
    public $timestamps = false;
    protected $fillable = ['message_content','message_content', 'message_date', 'message_label','is_seen','orderinfo_id', 'user_id', 'item_id','to_user'];

    public function user(){
    return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function recieve_user(){
    return $this->belongsTo('App\Models\User', 'to_user');
    }


    public function order(){
    return $this->belongsTo('App\Models\order', 'orderinfo_id');
    }

     public function item(){
    return $this->belongsTo('App\Models\item', 'item_id');
    }
}
