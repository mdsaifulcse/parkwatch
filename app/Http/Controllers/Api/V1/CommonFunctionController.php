<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Models\City;
use App\Models\Client;
use App\Models\Place;
use App\Models\Price;
use App\Models\Setting;
use App\Models\State;
use App\Models\VehicleType;
use App\Models\Zone;
use Illuminate\Http\Request;
use DB,MyHelper;
use Symfony\Component\HttpFoundation\Response;

class CommonFunctionController extends Controller
{
    use ApiResponseTrait;


    protected function uniqueUserValidation(Request $request)
    {
        try{

            $validateFields=[
               'checking_value'  => "required",
               'type'  => "required",
               // 'type'  => "required|in:email,mobile,username,nid",
                'user_id'=>'nullable',
            ];

            $validateResponse=$this->respondWithValidation($request->all(),$validateFields);

            if ($validateResponse!='pass')
            {
                return $this->respondWithError('Validation Fail',$validateResponse,Response::HTTP_UNPROCESSABLE_ENTITY);
            }


            $userId=$request->user_id;
            $type=$request->type;
            $checkingValue=$request->checking_value;
            $message='';


            $typeArray=['email','mobile','username'];

            if (!in_array($type, $typeArray))
            {
                return $this->respondWithError('Type must be one of:'.implode(",",$typeArray),[],Response::HTTP_UNPROCESSABLE_ENTITY);
            }


            if ($type=='email') {

                if ($userId!=''){
                    $userData=Client::where(['email'=>$checkingValue])->where('id','!=',$userId)->first();
                }else{
                    $userData=Client::where(['email'=>$checkingValue])->first();
                }

            }elseif ($type=='mobile'){

                if ($userId!='') {
                    $userData = Client::where(['mobile' => $checkingValue])->where('id', '!=', $userId)->first();
                }else {
                    $userData = Client::where(['mobile' => $checkingValue])->first();
                }

            }elseif ($type=='username'){

                if ($userId!='') {
                    $userData = Client::where(['username' => $checkingValue])->where('id', '!=', $userId)->first();
                }else {
                    $userData = Client::where(['username' => $checkingValue])->first();
                }

            }elseif ($type=='nid'){

                if ($userId!='') {
                    $userData = Client::where(['nid' => $checkingValue])->where('id', '!=', $userId)->first();
                }else {
                    $userData = Client::where(['nid' => $checkingValue])->first();
                }

            }

            if (empty($userData)){
                return $this->respondWithSuccess($type.' '.$checkingValue.' is unique ',[],Response::HTTP_OK);
            }else{
                return $this->respondWithSuccess($type.' '.$checkingValue.' already used ',[],Response::HTTP_UNPROCESSABLE_ENTITY);
            }


        }catch (\Exception $e)
        {
            return $this->respondWithError('Something Went Wrong !',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function getVehicleSizeData()
    {
        try{

           $vehicleTypes= VehicleType::get();

           foreach ($vehicleTypes as $key=>$vehicleType)
           {
               $vehicleTypes[$key]['image']=url($vehicleType->image);
           }

           return $this->respondWithSuccess('Vehicle Type Data ',$vehicleTypes,Response::HTTP_OK);

        }catch (\Exception $e)
        {
            return $this->respondWithError('Something Went Wrong !',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function parkingPriceUnite()
    {
        try{

            $parkingPriceUnit= Price::priceUnite();
            return $this->respondWithSuccess('Price Unit ',$parkingPriceUnit,Response::HTTP_OK);

        }catch (\Exception $e)
        {
            return $this->respondWithError('Something Went Wrong !',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function clientParkingInterest()
    {
        try{

            $parkingInterests= Client::parkingInterest();

//            $interestTrueFalse=[];
//            if (count($parkingInterests))
//            {
//                foreach ($parkingInterests as $key=>$parkingInterest){
//
//                    $interestTrueFalse[$key]=false;
//
//                }
//            }


            return $this->respondWithSuccess('Client Parking Interests ', $parkingInterests,Response::HTTP_OK);

        }catch (\Exception $e)
        {
            return $this->respondWithError('Something Went Wrong !',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    protected function checkUniqueUserByEmail(Request $request)
    {
        try{

            $validateFields=[
                'email'  => "required|unique:users|email|max:100",
            ];

            $validateResponse=$this->respondWithValidation($request->all(),$validateFields);

            if ($validateResponse!='pass')
            {
                return $this->respondWithError('Validation Fail',$validateResponse,Response::HTTP_UNPROCESSABLE_ENTITY);
            }


            return $this->respondWithSuccess('Email is unique ',[],Response::HTTP_OK);

        }catch (\Exception $e)
        {
            return $this->respondWithError('Something Went Wrong !',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    protected function checkUniqueUserByNid(Request $request)
    {
        try{

            $validateFields=[
                'nid'  => "required|unique:user_info|max:25",
            ];

            $validateResponse=$this->respondWithValidation($request->all(),$validateFields);

            if ($validateResponse!='pass')
            {
                return $this->respondWithError('Validation Fail',$validateResponse,Response::HTTP_UNPROCESSABLE_ENTITY);
            }


            return $this->respondWithSuccess('Nid is unique ',[],Response::HTTP_OK);

        }catch (\Exception $e)
        {
            return $this->respondWithError('Something Went Wrong !',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    public function getAboutCompany()
    {

        try{

           $aboutCompany=Setting::select('about','slider_1','slider_1_text','solution')->first();
           $aboutCompany->slider_1= url(asset($aboutCompany->slider_1));

            return $this->respondWithSuccess('About Company ',$aboutCompany,Response::HTTP_OK);

        }catch (\Exception $e)
        {
            return $this->respondWithError('Something Went Wrong !',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }




    public function getCountryWiseStateData($countryId)
    {

        $states=State::where(['status'=>State::PUBLISHED,'country_id'=>$countryId])->orderBy('id','DESC')->pluck('state_name','id')->toArray();

        return view('commonview.load-state-data',compact('states'));
    }

    public function getStateWiseCityData($stateId)
    {

        $cities=City::where(['status'=>City::PUBLISHED,'state_id'=>$stateId])->orderBy('id','DESC')->pluck('city_name','id')->toArray();

        return view('commonview.load-city-data',compact('cities'));
    }

    public function getCityWiseZoneData($cityId)
    {

        $zones=Zone::where(['status'=>Zone::PUBLISHED,'city_id'=>$cityId])->orderBy('id','DESC')->pluck('zone_name','id')->toArray();

        return view('commonview.load-zone-data',compact('zones'));
    }

    public function getOwnerWiseParkingSpotData($parkingOwnerId)
    {

        $parkingSpots=Place::where(['status'=>1,'user_id'=>$parkingOwnerId])->orderBy('id','DESC')->pluck('name','id')->toArray();

        return view('commonview.load-parking-spot-data',compact('parkingSpots'));
    }


}
