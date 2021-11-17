<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientVehicle extends Model
{
    const PUBLISHED='Published';
    const UNPUBLISHED='Unpublished';

    const YES='Yes';
    const NO='No';

    protected $table = 'client_vehicle';
    protected $fillable = ['client_id','vehicle_type_id','vehicle_type','vehicle_photo','make','model','color','licence','is_primary','status'];

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class,'vehicle_type_id','id');
    }

}
