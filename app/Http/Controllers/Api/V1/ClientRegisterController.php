<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Traits\ApiResponseTrait;
use App\Models\Client;
use App\Models\ClientParkingInterest;
use App\Models\ClientVehicle;
use App\Models\Place;
use App\Models\Price;
use App\Models\Vehicle;
use App\Models\VehicleType;
use App\Models\WeekLyParkingTime;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use DB,MyHelper;
class ClientRegisterController extends Controller
{
    use ApiResponseTrait;

    public function register(Request $request)
    {
        // insert into table (client,client_vehicle,client_parking_interests,weekly_parking_times)


        $validateFields=[
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email'  => "required|unique:client|email|max:100",
            'mobile'  => "required|unique:client|max:15|min:8", //"regex:/(01)[0-9]{9}/", //
            'username'  => "required|unique:client|max:100",
            //'profile_photo' => 'nullable|image|mimes:jpg,jpeg,bmp,png,webp,gif|max:5120',

            'working_address' => 'nullable|max:200',
            'home_address' => 'nullable|max:200',
            'parking_start_date' => 'required',
            'parking_end_date' => 'required',
            //'parking_interest' => 'required',
            'parking_interest' => 'required|array|min:1',

            'parking_buddy_radius' => 'required|numeric|between:0,0.4',
            //'vehicle_type_id' => 'required|exists:vehicle_type,id',
            //'vehicle_photo' => 'nullable|image|mimes:jpg,jpeg,bmp,png,webp,gif|max:5120',
            'licence' => 'required|max:30',
            'vehicle_type' => 'nullable|max:30',
            'make' => 'nullable|max:30',
            'model' => 'nullable|max:30',
            'color' => 'nullable|max:30',
            'rent_out_from_other' => 'required|numeric|digits_between:0,1',
            'rent_out_my_space' => 'required|numeric|digits_between:0,1',
            'rent_out_my_space_details' => 'array|nullable',

            'find_parking_by_work_address' => 'array|required',
            'leave_parking_after_work' => 'array|required',
            'arrived_home_find_parking' => 'array|required',
            'home_parking_leaving_time' => 'array|required',

            'password' => 'required|min:6|max:15|confirmed',
        ];


        $validateResponse=$this->respondWithValidation($request->all(),$validateFields);

        if ($validateResponse!='pass')
        {
            return $this->respondWithError('Validation Fail',$validateResponse,Response::HTTP_UNPROCESSABLE_ENTITY);
        }


        DB::beginTransaction();
        try{

            $clientInput=$request->all();
            $clientInput['id_no']=$this->randStr();
            $clientInput['password']=bcrypt($request->password);

            if (!is_null($request->parking_start_date))
            {
                $clientInput['parking_start_date']=date('y-m-d',strtotime($request->parking_start_date));
            }
            if (!is_null($request->parking_end_date))
            {
                $clientInput['parking_end_date']=date('y-m-d',strtotime($request->parking_end_date));
            }

            if ($request->hasFile('profile_photo'))
            {
                $clientInput['profile_photo']=\MyHelper::fileUpload($request->file('profile_photo'),'images/client-profile-photo/');
            }

            $client= Client::create($clientInput);

            $clientId=$client->id;

            $this->storeClientVehicle($request,$clientId);
            $this->storeClientParkingInterest($request,$clientId);
            $this->storeClientWeeklyParkingTime($request,$clientId);

            if ($request->has('rent_out_my_space') && $request->rent_out_my_space==1)
            {
                Client::storeClientRentingOutParking($request,$client);
            }

            DB::commit();

            return $this->respondWithSuccess('You have been successfully Registered',[],Response::HTTP_CREATED);
        }catch (Exception $e)
        {
            DB::rollback();
            return $this->respondWithError('Something Went Wrong !',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function randStr()
    {
        $lastTokenNo = Client::orderBy('id_no','desc')
            ->value('id_no');

        $lastTokenNo = (!empty($lastTokenNo)?$lastTokenNo:'A0000');

        $letter = $lastTokenNo[0];
        $number = $lastTokenNo[1].$lastTokenNo[2].$lastTokenNo[3].$lastTokenNo[4];

        if ($number < 9999) {
            $newTokenNo = $letter.sprintf("%04d", (int)$number+1);
        } else {
            $ascii = ord($letter);
            $newLetter = chr($ascii+1);
            $newTokenNo = $newLetter.'0001';
        }
        return $newTokenNo;
    }


    public function storeClientRentingOutParking($request,$client)
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


    public function storeClientVehicle($request,$clientId)
    {

        $vehiclePhoto='';
        if ($request->hasFile('vehicle_photo')){
            $vehiclePhoto=\MyHelper::fileUpload($request->file('vehicle_photo'),'images/vehicle-photo/');
        }


        $clientVehicle=ClientVehicle::create(
            [
                'client_id'=>$clientId,
                'vehicle_type_id'=>$request->vehicle_type_id,
                'vehicle_photo'=>$vehiclePhoto,
                'vehicle_type'=>$request->vehicle_type,
                'make'=>$request->make,
                'model'=>$request->model,
                'color'=>$request->color,
                'licence'=>$request->licence,
                'is_primary'=>ClientVehicle::YES,
            ]);
    }

    public function storeClientParkingInterest($request,$clientId)
    {

        $parkingInterests=$request->parking_interest;
        if (count($parkingInterests)>0)
        {

            foreach ($parkingInterests as $interest) {
                $clientParkingInterest = ClientParkingInterest::create(
                    [
                        'client_id' => $clientId,
                        'parking_interest' => $interest,
                    ]);
            }
        }

    }

    public function storeClientWeeklyParkingTime($request,$clientId)
    {

        if(count($request->find_parking_by_work_address)>0)
        {
            foreach ($request->find_parking_by_work_address as $key=>$homeParkingLeave){
               $inputData[]= [
                    'client_id'=>$clientId,
                    'find_parking_by_work_address'=>1,
                    'day_time'=>$homeParkingLeave['day_time'],
                    'mon_day'=>$homeParkingLeave['mon_day'],
                    'tue_day'=>$homeParkingLeave['tue_day'],
                    'wed_day'=>$homeParkingLeave['wed_day'],
                    'thu_day'=>$homeParkingLeave['thu_day'],
                    'fri_day'=>$homeParkingLeave['fri_day'],
                    'sat_day'=>$homeParkingLeave['sat_day'],
                    'sun_day'=>$homeParkingLeave['sun_day'],
                ];
            }
            WeekLyParkingTime::insert($inputData);
        }

        if(count($request->leave_parking_after_work)>0)
        {
            foreach ($request->leave_parking_after_work as $key=>$findBeforeWork){
               $findParkingInout[]= [
                    'client_id'=>$clientId,
                    'leave_parking_after_work'=>1,
                    'day_time'=>$findBeforeWork['day_time'],
                    'mon_day'=>$findBeforeWork['mon_day'],
                    'tue_day'=>$findBeforeWork['tue_day'],
                    'wed_day'=>$findBeforeWork['wed_day'],
                    'thu_day'=>$findBeforeWork['thu_day'],
                    'fri_day'=>$findBeforeWork['fri_day'],
                    'sat_day'=>$findBeforeWork['sat_day'],
                    'sun_day'=>$findBeforeWork['sun_day'],
                ];
            }
            WeekLyParkingTime::insert($findParkingInout);
        }

        if(count($request->arrived_home_find_parking)>0)
        {
            foreach ($request->arrived_home_find_parking as $key=>$leaveAfterWork){
               $leaveParkingInput[]= [
                    'client_id'=>$clientId,
                    'arrived_home_find_parking'=>1,
                    'day_time'=>$leaveAfterWork['day_time'],
                    'mon_day'=>$leaveAfterWork['mon_day'],
                    'tue_day'=>$leaveAfterWork['tue_day'],
                    'wed_day'=>$leaveAfterWork['wed_day'],
                    'thu_day'=>$leaveAfterWork['thu_day'],
                    'fri_day'=>$leaveAfterWork['fri_day'],
                    'sat_day'=>$leaveAfterWork['sat_day'],
                    'sun_day'=>$leaveAfterWork['sun_day'],
                ];
            }
            WeekLyParkingTime::insert($leaveParkingInput);
        }

        if(count($request->home_parking_leaving_time)>0)
        {
            foreach ($request->home_parking_leaving_time as $key=>$leaveAfterWork){
               $leaveParkingInput[]= [
                    'client_id'=>$clientId,
                    'home_parking_leaving_time'=>1,
                    'day_time'=>$leaveAfterWork['day_time'],
                    'mon_day'=>$leaveAfterWork['mon_day'],
                    'tue_day'=>$leaveAfterWork['tue_day'],
                    'wed_day'=>$leaveAfterWork['wed_day'],
                    'thu_day'=>$leaveAfterWork['thu_day'],
                    'fri_day'=>$leaveAfterWork['fri_day'],
                    'sat_day'=>$leaveAfterWork['sat_day'],
                    'sun_day'=>$leaveAfterWork['sun_day'],
                ];
            }
            WeekLyParkingTime::insert($leaveParkingInput);
        }


    }


    public function registerOld(Request $request)
    {
        // insert into table (client,client_vehicle,client_parking_interests,weekly_parking_times)

        return $request->all();

        $validateFields=[
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email'  => "required|unique:client|email|max:100",
            'mobile'  => "required|unique:client|max:15|min:8|regex:/(01)[0-9]{9}/",
            'username'  => "required|unique:client|max:100",
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,bmp,png,webp,gif|max:5120',

            'working_address' => 'nullable|max:200',
            'home_address' => 'nullable|max:200',
            'parking_start_date' => 'required',
            'parking_end_date' => 'required',
            //'parking_interest' => 'required',
            'parking_interest' => 'required|array|min:1',

            'parking_buddy_radius' => 'required|numeric|digits_between:0,15',
            'vehicle_type_id' => 'required|exists:vehicle_type,id',
            'vehicle_photo' => 'nullable|image|mimes:jpg,jpeg,bmp,png,webp,gif|max:5120',
            'licence' => 'required|max:30',
            'make' => 'nullable|max:30',
            'model' => 'nullable|max:30',
            'color' => 'nullable|max:30',
            'password' => 'required|min:6|confirmed',
        ];


        $validateResponse=$this->respondWithValidation($request->all(),$validateFields);

        if ($validateResponse!='pass')
        {
            return $this->respondWithError('Validation Fail',$validateResponse,Response::HTTP_UNPROCESSABLE_ENTITY);
        }


        DB::beginTransaction();
        try{

            $clientInput=$request->all();

            if (!is_null($request->parking_start_date)){
                $clientInput['parking_start_date']=date('y-m-d',strtotime($request->parking_start_date));
            }
            if (!is_null($request->parking_end_date)){
                $clientInput['parking_end_date']=date('y-m-d',strtotime($request->parking_end_date));
            }

            if ($request->hasFile('profile_photo')){
                $clientInput['profile_photo']=\MyHelper::fileUpload($request->file('profile_photo'),'images/client-profile-photo/');
            }

            $client= Client::create($clientInput);

            $this->storeClientVehicle($request,$client->id);

            DB::commit();

            return $this->respondWithSuccess('Data Successfully Saved',[],Response::HTTP_CREATED);
        }catch (Exception $e)
        {
            DB::rollback();
            return $this->respondWithError('Something Went Wrong !',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
