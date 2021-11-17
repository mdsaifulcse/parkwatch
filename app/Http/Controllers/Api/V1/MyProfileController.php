<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\MyProfileResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Client;
use App\Models\ClientParkingInterest;
use App\Models\ClientVehicle;
use App\Models\Vehicle;
use App\Models\WeekLyParkingTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use DB,MyHelper;
class MyProfileController extends Controller
{
    use ApiResponseTrait;

    public function myProfileUpdate(Request $request)
    {

        $id=auth()->user()->id;
        DB::beginTransaction();
        try{

            $validateFields=[
                'first_name' => 'nullable|max:50',
                'last_name' => 'nullable|max:50',
                'email'  => "nullable|unique:client,email,$id|email|max:100",
                'mobile'  => "nullable|unique:client,mobile,$id|max:15|min:8", //"regex:/(01)[0-9]{9}/", //
                //'username'  => "nullable|unique:client,username,$id|max:100",
                'profile_photo' => 'nullable|image|mimes:jpg,jpeg,bmp,png,webp,gif|max:5120',

                'working_address' => 'nullable|max:200',
                'home_address' => 'nullable|max:200',

                //'parking_interest' => 'nullable|array|min:1',

                'vehicle_type' => 'nullable|max:30',
                'vehicle_type_id' => 'nullable|exists:vehicle_type,id',
                'licence' => 'nullable|max:30',
                'make' => 'nullable|max:30',
                'model' => 'nullable|max:30',
                'color' => 'nullable|max:30',
                'parking_buddy_radius' => 'nullable|numeric|digits_between:0,15',
                'password' => 'nullable|min:6|max:15',
            ];

            $validateResponse=$this->respondWithValidation($request->all(),$validateFields);

            if ($validateResponse!='pass')
            {
                return $this->respondWithError('Validation Fail',$validateResponse,Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $client=Client::where('id',$id)->first();
            $newInput=$request->all();

            if ($request->has('password') && !empty($request->password))
            {
                $newInput['password']=bcrypt($request->password);
            }

            if ($request->hasFile('profile_photo')){
                $newInput['profile_photo']=\MyHelper::fileUpload($request->file('profile_photo'),'images/client-profile-photo/');

                if (file_exists($client->profile_photo))
                {
                    unlink($client->profile_photo);
                }
            }


            $client->update($newInput);

            $this->updateClientVehicle($request,$id);

            if ($request->has('parking_interest') && is_array($request->parking_interest))
            {
                $this->updateClientParkingInterest($request, $id);
            }

            DB::commit();

            $myProfile=Client::with('vehicleInfo','vehicleInfo.vehicleType','clientParkingInterest')->findOrFail($id);

            return $this->respondWithSuccess('Updated Profile Data ',New MyProfileResource($myProfile),Response::HTTP_OK);

        }catch (\Exception $e)
        {
            DB::rollback();
            return $this->respondWithError('Something Went Wrong !',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



    public function updateClientVehicle($request,$clientId)
    {

        $clientVehicle=ClientVehicle::where(['client_id'=>$clientId])->orderBy('id','ASC')->first();


        $clientVehicle->update($request->all());
    }


    public function updateClientParkingInterest($request,$clientId)
    {

        $parkingInterests=$request->parking_interest;
        if (count($parkingInterests)>0)
        {
            $clientParkingInterests=ClientParkingInterest::where('client_id',$clientId)->delete();

            foreach ($parkingInterests as $interest) {
                $clientParkingInterest = ClientParkingInterest::create(
                    [
                        'client_id' => $clientId,
                        'parking_interest' => $interest,
                    ]);
            }
        }

    }


    public function getMyProfileData()
    {

        try{

          $myProfile=Client::with('vehicleInfo','vehicleInfo.vehicleType','clientParkingInterest')->findOrFail(auth()->user()->id);

            return $this->respondWithSuccess('My Profile Details',New MyProfileResource($myProfile),Response::HTTP_OK);
        }catch (Exception $e)
        {
            return $this->respondWithError('Something Went Wrong !',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function rentOutMyParkingSpot(Request $request)

    {

        $validateFields=[
            'rent_out_my_space_details' =>'required|array|min:1',
        ];


        $validateResponse=$this->respondWithValidation($request->all(),$validateFields);

        if ($validateResponse!='pass')
        {
            return $this->respondWithError('Validation Fail',$validateResponse,Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $clientId=auth()->user()->id;
        $clientName=auth()->user()->first_name.' '.auth()->user()->last_name;

        DB::beginTransaction();
        try{

            Client::storeClientRentingOutParking($request,$clientId,$clientName);

            DB::commit();
            return $this->respondWithSuccess('Your New Parking Location Successfully Save',[],Response::HTTP_OK);
        }catch (Exception $e)
        {
            DB::rollback();
            return $this->respondWithError('Something Went Wrong !',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
