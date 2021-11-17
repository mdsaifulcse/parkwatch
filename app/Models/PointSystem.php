<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointSystem extends Model
{
    const ACTIVE='Active';
    const INACTIVE='Inactive';

    protected $table='point_systems';
    protected $fillable=['min_point','max_point','badge_name','badge_icon','status'];
}
