<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zone extends Model
{
    use SoftDeletes;
    const PUBLISHED='Published';
    const UNPUBLISHED='Unpublished';


    protected $table = 'zones';
    protected $fillable = ['city_id','zone_name','status'];

    public function city()
    {
        return $this->belongsTo(City::class,'city_id','id');
    }
}
