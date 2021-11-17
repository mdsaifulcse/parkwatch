<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeekLyParkingTime extends Model
{

    const FINDPARKINGBYWORKADDRESS='find_parking_by_work_address';
    const LEAVEPARKINGAFTERWORK='leave_parking_after_work';
    const ARRIVEDHOMEFINDPARKING='arrived_home_find_parking';
    const HOMEPARKINGLEAVINGTIME='home_parking_leaving_time';

    protected $table = 'weekly_parking_times';
    protected $fillable = ['client_id','find_parking_by_work_address','leave_parking_after_work','arrived_home_find_parking','home_parking_leaving_time','day_time','mon_day','tue_day','wed_day','thu_day','fri_day','sat_day','sun_day'];

}
