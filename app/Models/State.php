<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use SoftDeletes;
    const PUBLISHED='Published';
    const UNPUBLISHED='Unpublished';

    protected $table = 'states';
    protected $fillable = ['country_id','state_name','status'];


    public function country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }

}
