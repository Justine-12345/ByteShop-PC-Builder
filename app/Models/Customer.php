<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;


    public $primaryKey = 'customer_id';
  
    protected $fillable = ['fname','lname','addressline','city','zipcode',
        'phone','user_id'
    ];

     public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

       public function orders(){
        return $this->hasMany(Order::class, 'customer_id');
    }
}
