<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    const BOOKREQUEST=0;
    const BOOKED=1;
    const RELEASE=2;

    const PAID=1;
    const UNPAID=0;

	public $timestamps = true;

	protected $table = 'booking';
	protected $fillable=['id_no','client_id_no','vehicle_licence','place_id','price_id','promocode_id','promocode','space',
        'arrival_time','departure_time','release_time','booking_period','unit','unit_price','net_price','discount','vat','fine',
        'total_price','note','release_note','payment_at','created_by','payment_type','booking_status'];
}
