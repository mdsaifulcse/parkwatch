<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BookingHistory
 * @package App
 */
class BookingHistory extends Model
{
    /**
     * @var string
     */
    protected $table = 'booking_history';

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];


    /**
     * @var array
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['transaction_id','booking_id','booking_id_no','client_id_no','payment_gateway', 'amount', 'data', 'payment_status'];
}