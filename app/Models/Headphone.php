<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Headphone extends Model
{
    use HasFactory;

    protected $primaryKey = 'headphone_id';
    public $timestamps = false;
    protected $fillable = ['frequency_response', 'transducer_principle', 'driver_size', 'nominal_impedance', 'headphone_sensivity', 'weight', 'headphones_desciption', 'item_id'];

    public function item(){
        return $this->belongsTo('App\Models\Item', 'item_id');
    }
}
