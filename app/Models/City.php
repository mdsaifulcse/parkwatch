<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;
    const PUBLISHED='Published';
    const UNPUBLISHED='Unpublished';

    protected $table = 'cities';
    protected $fillable = ['state_id','city_name','status'];

    public function state()
    {
        return $this->belongsTo(State::class,'state_id','id');
    }
}
