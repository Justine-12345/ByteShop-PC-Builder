<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orderinfo';

    protected $primaryKey = 'orderinfo_id';

    protected $fillable = ['customer_id','date_placed', 'date_shipped','shipping_fee', 'status', 'code'];

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function items(){
        return $this->belongsToMany('App\Models\Item','orderline','orderinfo_id', 'item_id')->withPivot('quantity')->withPivot('is_reviewed');
    }

    public function messages(){
        return $this->hasMany(Message::class, 'orderinfo_id');
    }

}
