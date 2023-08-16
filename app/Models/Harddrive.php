<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harddrive extends Model
{
    use HasFactory;

    protected $primaryKey = 'harddrive_id';
    public $timestamps= false;
    protected $fillable = ['storage_type', 'capacity', 'rotational_speed', 'connectivity_type', 'transfer_rate', 'cache_size', 'power', 'height', 'dept', 'width', 'weight', 'harddrive_description', 'item_id'];

    public function item(){
        return $this->belongsTo('App\Models\Item', 'item_id');
    }
}
