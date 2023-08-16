<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soliddrive extends Model
{
    use HasFactory;
    protected $primaryKey = 'soliddrive_id';
    public $timestamps = false;
    protected $fillable = ['form_factor', 'interface', 'read_speed', 'write_speed', 'endurance_rating', 'iops', 'capacity', 'cell_type', 'soliddrive_description', 'item_id'];

    public function item(){
        return $this->belongsTo('App\Models\Item', 'item_id');
    }

}
