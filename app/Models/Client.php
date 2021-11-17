<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Client extends Authenticatable implements JWTSubject
{
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }


    const OTP_NOT_VERIFIED='Not_Verified';
    const OTP_VERIFIED='Verified';

    const FREE_STREET_PARKING='Free Street Parking';
    const METERED_STREET_PARKING='Meter Street Parking';
    const GARAGE_PARKING='Garage Parking';
    const RENT_OUT_FROM_OTHER='Rent Out From Other';

    public static function parkingInterest()
    {
        return [
            self::FREE_STREET_PARKING=>false,
            self::METERED_STREET_PARKING=>false,
            self::GARAGE_PARKING=>false,
            self::RENT_OUT_FROM_OTHER=>false,
        ];
    }

	public $timestamps = true;

	protected $table = "client";

	protected $fillable=['id_no','first_name','last_name','username','username','mobile','email','password','working_address','home_address','parking_start_date','parking_end_date','single_parking_id','parking_buddy_radius','note','rent_out_from_other','rent_out_my_space','profile_photo','status','password_reset_otp','otp_validity','otp_status','my_point','terms_condition','privacy_policy','parking_buddy_laws'];


	public function vehicleInfo()
    {
        return $this->hasOne(ClientVehicle::class,'client_id','id')->orderBy('client_vehicle.client_id','ASC');
    }

	public function clientParkingInterest()
    {
        return $this->hasMany(ClientParkingInterest::class,'client_id','id')
            ;
    }

    public function pointAndRank()
    {
        return self::orderBy('my_point','DESC')->get();
    }



    public static function storeClientRentingOutParking($request,$client)
    {

        $rentOutMySpaceDetails=$request->rent_out_my_space_details;
        if (count($rentOutMySpaceDetails)>0)
        {
            $vehicleType=VehicleType::first();

            if (empty($vehicleType))
            {
                $vehicleType=VehicleType::create(
                    [
                        'name'=>'Standard Vehicle',
                        'status'=>1
                    ]
                );
            }

            $userInput['name']=$request->first_name.' '.$request->first_name;
            $userInput['email']=$request->email;
            $userInput['password']=bcrypt($request->password);
            $userInput['photo']=$client->profile_photo;
            $userInput['status']=1;
            $userInput['user_role']=User::PARKING_OWNER;

            $user=User::create($userInput);


            foreach ($rentOutMySpaceDetails as $key=>$rentOutMySpaceDetail) {

                $availableFrom=date('Y-m-d',strtotime(today())).' '.$rentOutMySpaceDetail['available_from'];
                $availableTo=date('Y-m-d',strtotime(today()->addYear(2))).' '.$rentOutMySpaceDetail['available_to'];

                $rentOuPlace = Place::create(
                    [
                        'type' => Price::CLIENTASPARKINGOWNER,
                        'user_id' => $user->id,
                        'client_id' => $client->id,
                        'name' => $client->first_name.' '.$client->last_name,
                        'address' => $rentOutMySpaceDetail['address'],
                        'latitude' => $rentOutMySpaceDetail['latitude'],
                        'longitude' => $rentOutMySpaceDetail['longitude'],
                        'limit' => 1,
                        'space' => 1,
                        'status' => 1,
                        'available_from' =>$availableFrom,
                        'available_to' =>$availableTo,
                    ]);

                Price::create([
                    'type' => Price::CLIENTASPARKINGOWNER,
                    'user_id' => $user->id,
                    'client_id' => $client->id,
                    'place_id' => $rentOuPlace->id,
                    'vehicle_type_id' => $vehicleType->id,
                    'price' => $rentOutMySpaceDetail['price'],
                    'time' => 1,
                    'unit' => $rentOutMySpaceDetail['unit'],
                ]);
            }
        }
    }

    public static function storeDrivewayRentingOutParking($request,$userId,$name)
    {

        $rentOutMySpaceDetails=$request->rent_out_my_space_details;
        if (count($rentOutMySpaceDetails)>0)
        {
            $vehicleType=VehicleType::first();

            if (empty($vehicleType))
            {
                $vehicleType=VehicleType::create(
                    [
                        'name'=>'Standard Vehicle',
                        'status'=>1
                    ]
                );
            }


            foreach ($rentOutMySpaceDetails as $key=>$rentOutMySpaceDetail) {

                $availableFrom=date('Y-m-d',strtotime(today())).' '.$rentOutMySpaceDetail['available_from'];
                $availableTo=date('Y-m-d',strtotime(today()->addYear(2))).' '.$rentOutMySpaceDetail['available_to'];

                $rentOuPlace = Place::create(
                    [
                        'type' => Price::CLIENTASPARKINGOWNER,
                        'user_id' => $userId,
                        'name' => $name,
                        'address' => $rentOutMySpaceDetail['address'],
                        'latitude' => $rentOutMySpaceDetail['latitude'],
                        'longitude' => $rentOutMySpaceDetail['longitude'],
                        'limit' => 1,
                        'space' => 1,
                        'status' => 1,
                        'available_from' =>$availableFrom,
                        'available_to' =>$availableTo,
                    ]);

                Price::create([
                    'type' => Price::CLIENTASPARKINGOWNER,
                    'user_id' => $userId,
                    'place_id' => $rentOuPlace->id,
                    'vehicle_type_id' => $vehicleType->id,
                    'price' => $rentOutMySpaceDetail['price'],
                    'time' => 1,
                    'unit' => $rentOutMySpaceDetail['unit'],
                ]);
            }
        }
    }


}
