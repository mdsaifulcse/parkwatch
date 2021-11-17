<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    const PARKINGOWNER='ParkingOwner';
    const CLIENTASPARKINGOWNER='ClientAsParkingOwner';

    const MINUTE='minute';
    const HOUR='hours';
    const DAY='day';
    const MONTH='month';
    const YEAR='year';

    public $timestamps = false;

    protected $table = "price";

    protected $fillable=['type','user_id','client_id','place_id','vehicle_type_id','time','unit','price','note','status'];

    public function client()
    {
        return $this->belongsTo(Client::class,'client_id','id');
    }

    public static function priceUnite()
    {
        return [
            self::MINUTE => 'Minute(s)',
            self::HOUR   => 'Hour(s)',
            self::DAY    => 'Day(s)',
            self::MONTH  => 'Month(s)',
            self::YEAR   => 'Year(s)',
        ];
    }
}
