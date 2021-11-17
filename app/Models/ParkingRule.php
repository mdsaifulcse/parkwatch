<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParkingRule extends Model
{
    use SoftDeletes;
    const PUBLISHED='Published';
    const UNPUBLISHED='Unpublished';

    const YES='Yes';
    const NO='No';

    protected $table = 'parking_rules';
    protected $fillable = ['name','description','is_legal','available_date_time','vehicle_restriction','status'];

}
