<?php

namespace App\Models;

use GuzzleHttp\Promise\Create;
use Illuminate\Database\Eloquent\Model;

class UserPointNotification extends Model
{
    const READ='Read';
    const UNREAD='Unread';

    const NOTIFYAVAILABLEPARKINGSPOT='Notify_Available_parking_Spot_To_App';
    const NOTIFYUSERAVAILABLEPARKINGSPOT='Notify_Available_parking_Spot_To_User';
    const GETPARKINGSPOTFROMOTHERUSER='Get_Parking_Spot_From_Other_User';
    const GIVEPARKINGSPOTTOOTHERUSER='Give_Parking_Spot_To_Other_User';
    const SHAREAPPWITHOTHERUSER='Share_App_With_Other_User';
    const PARKEDUSEINGAPP='Parked_Using_App';
    const EVERYDAYAPPUSER='Every_Day_App_Use';

    const ACTIONNAME=[self::NOTIFYAVAILABLEPARKINGSPOT,self::NOTIFYUSERAVAILABLEPARKINGSPOT,self::GETPARKINGSPOTFROMOTHERUSER,self::GIVEPARKINGSPOTTOOTHERUSER,self::SHAREAPPWITHOTHERUSER,self::PARKEDUSEINGAPP,self::EVERYDAYAPPUSER];

    protected $table = 'user_point_notifications';
    protected $fillable = ['client_id','point','action_name','status','action_date'];


//   public static function storeUserPoint($request)
//   {
//
//       $userPoint=self::where(['client_id'=>$request->client_id,'action_name'=>$request->action_name])->first();
//
//       if (empty($userPoint)){Parked_Using_App
//           self::create([
//               'client_id'=>$request->client_id,
//               'point'=>1,
//               'action_name'=>$request->action_name,
//           ]);
//       }else{
//           $userPoint->increment('point');
//       }
//
//   }

}
