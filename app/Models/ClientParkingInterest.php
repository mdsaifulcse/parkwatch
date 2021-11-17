<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientParkingInterest extends Model
{
    protected $table = 'client_parking_interests';
    protected $fillable = ['client_id','parking_interest'];
}
