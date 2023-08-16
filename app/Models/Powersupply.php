<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Powersupply extends Model
{
    use HasFactory;

    protected $primaryKey = 'powersupply_id';
    public $timestamps = false;
    protected $fillable = ['form_factor', 'wattage', 'efficiency_rating', 'rails', 'protection', 'modularity', 'variable_rpmfan', 'fan_size', 'powersupplies_description', 'item_id'];

    public function item(){
        return $this->belongsTo('App\Models\Item', 'item_id');
    }
}
