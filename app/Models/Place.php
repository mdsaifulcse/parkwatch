<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{

    const PARKINGOWNER='ParkingOwner';
    const CLIENTASPARKINGOWNER='ClientAsParkingOwner';

	public $timestamps = true;

	protected $table = "place";

    protected $fillable = [
        'type','user_id','client_id','zone_id','parking_rule_id',
		'name','address',
		'latitude','longitude',
		'limit','serials',
		'note','status',
        'available_from','available_to'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class,'client_id','id');
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class,'zone_id','id');
    }

    public function parkingSpotPrice()
    {
        return $this->hasOne(Price::class,'place_id','id')
            ->where('unit',Price::HOUR);

    }

}
