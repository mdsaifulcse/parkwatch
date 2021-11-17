<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\MyProfileResource;
use App\Http\Resources\SearchResource;
use App\Http\Resources\SearchResourceCollection;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Client;
use App\Models\ClientParkingInterest;
use App\Models\ClientVehicle;
use App\Models\Place;
use App\Models\Price;
use App\Models\Vehicle;
use App\Models\WeekLyParkingTime;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use DB,MyHelper;
class DrivewayController extends Controller
{
    use ApiResponseTrait;

    public function myProfileUpdate(Request $request)
    {

        $id=auth($this->userApi())->user()->id;
        DB::beginTransaction();
        try{

            $validateFields=[
                'name' => 'required|max:50',
                'email'  => "required|unique:users,email,$id|email|max:100",
                'photo' => 'nullable|image|mimes:jpg,jpeg,bmp,png,webp,gif|max:5120',
            ];

            $validateResponse=$this->respondWithValidation($request->all(),$validateFields);

            if ($validateResponse!='pass')
            {
                return $this->respondWithError('Validation Fail',$validateResponse,Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $user=User::where('id',$id)->first();
            $newInput=$request->all();

            if ($request->has('password') && !empty($request->password))
            {
                $newInput['password']=bcrypt($request->password);
            }

            if ($request->hasFile('photo')){
                $newInput['photo']=\MyHelper::fileUpload($request->file('photo'),'images/driveway-profile-photo/');

                if (file_exists($user->photo))
                {
                    unlink($user->photo);
                }
            }


            $user->update($newInput);

            /*if ($request->has('parking_interest') && is_array($request->parking_interest))
            {
                $this->updateClientParkingInterest($request, $id);
            }*/

            DB::commit();

            $myProfile=User::findOrFail($id);

            $myProfile->photo= !empty($myProfile->photo)?url('/'.$myProfile->photo):'';

            return $this->respondWithSuccess('My(Driveway) Profile Update Successfully',$myProfile,Response::HTTP_OK);
        }catch (\Exception $e)
        {
            DB::rollback();
            return $this->respondWithError('Something Went Wrong !',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getMyProfileData()
    {

        try{

            $myProfile=User::findOrFail(auth($this->userApi())->user()->id);

            $myProfile->photo= !empty($myProfile->photo)?url('/'.$myProfile->photo):'';

            return $this->respondWithSuccess('My(Driveway) Profile Details',$myProfile,Response::HTTP_OK);
        }catch (\Exception $e)
        {
            return $this->respondWithError('Something Went Wrong !',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



    public function myParkingSpots(Request $request)
    {
        $userId=auth($this->userApi())->user()->id;
        try{

            $parkingSportResult=$this->parkingLotListWithSpaces($userId);

            return $this->respondWithSuccess('Parking Search Result ',SearchResourceCollection::make($parkingSportResult),Response::HTTP_OK);

//            $parkingSportResult=Place::with('parkingSpotPrice')
//                ->where('address', 'like','%'.$request->location.'%')->paginate(5);

        }catch (\Exception $e)
        {
            return $this->respondWithError('Something Went Wrong !',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function parkingLotListWithSpaces($userId,$parkingId=null)
    {
        $lots = DB::table("place AS p")
            ->select(
                'p.id','p.type','p.name','p.address','p.available_from',
                'p.available_to','p.latitude','p.longitude','pr.time',
                'pr.unit','pr.price',
                DB::raw('CONCAT(p.id ,",", p.latitude, "," ,p.longitude) AS geolocation'),
                'p.limit',
                DB::raw('CASE WHEN COUNT(pr.place_id)>0 THEN True ELSE False END AS is_price')
            )
            ->join("price AS pr", "pr.place_id", "=", "p.id")
            ->where('p.status', 1);


        if (!is_null($parkingId))
        {
            return  $lots=$lots->where(['p.id'=> $parkingId,'p.user_id'=>$userId])->groupBy("p.id")->first();
        }else{

            return $lots=$lots->where('p.user_id', $userId)
                ->groupBy("p.id")->paginate(20);
        }
    }

    public function parkingSpotByParkingId($parkingId)
    {
        $userId=auth($this->userApi())->user()->id;
        try{

           $parkingSportResult =$this->parkingLotListWithSpaces($userId,$parkingId);

           if (empty($parkingSportResult))
           {
               return $this->respondWithError('No Data Found !',[],Response::HTTP_NOT_FOUND);
           }


            return $this->respondWithSuccess('Parking Spot Detail ',New SearchResource($parkingSportResult),Response::HTTP_OK);

        }catch (Exception $e)
        {
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

        $userId=auth($this->userApi())->user()->id;
        $name=auth($this->userApi())->user()->name;

        DB::beginTransaction();
        try{

            Client::storeDrivewayRentingOutParking($request,$userId,$name);

            DB::commit();
            return $this->respondWithSuccess('Your New Parking Location Successfully Save',[],Response::HTTP_OK);
        }catch (Exception $e)
        {
            DB::rollback();
            return $this->respondWithError('Something Went Wrong !',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function updateDrivewayParkingSpot(Request $request)
    {

        $validateFields=[
            //'rent_out_my_space_details' =>'required|array|min:1',
            'address' =>'required|max:250',
            'latitude' =>'required',
            'longitude' =>'required',
            'price' =>'required|numeric|digits_between:0,9999999',
            'unit' =>'required|max:50',
            'available_from' =>'required|date',
            'available_to' =>'required|date',
            'place_id' =>'required|exists:place,id',
        ];


        $validateResponse=$this->respondWithValidation($request->all(),$validateFields);

        if ($validateResponse!='pass')
        {
            return $this->respondWithError('Validation Fail',$validateResponse,Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $parkingId=$request->place_id;
        $userId=auth($this->userApi())->user()->id;

        $parkingSportResult =$this->parkingLotListWithSpaces($userId,$parkingId);

        if (empty($parkingSportResult))
        {
            return $this->respondWithError('No Data Found !',[],Response::HTTP_NOT_FOUND);
        }


        DB::beginTransaction();
        try{

            Place::where(['id'=>$parkingId,'user_id'=>$userId])->update([
                'address'=>$request->address,
                'latitude'=>$request->latitude,
                'longitude'=>$request->longitude,
            ]);

            $spotPrice=Price::where(['place_id'=>$parkingId,'user_id'=>$userId])->orderBy('id','DESC')->first();

            $availableFrom=date('Y-m-d',strtotime(today())).' '.$request->available_from;
            $availableTo=date('Y-m-d',strtotime(today()->addYear(2))).' '.$request->available_to;

            if (!empty($spotPrice))
            {
                $spotPrice->update([
                    'price'=>$request->price,
                    'unit'=>$request->unit,
                    'available_from'=>$availableFrom,
                    'available_to'=>$availableTo,
                ]);
            }else{

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

                Price::create(
                    [
                        'type' => Price::CLIENTASPARKINGOWNER,
                        'vehicle_type_id' => $vehicleType->id,
                        'user_id' => $userId,
                        'place_id' => $parkingId,
                        'price'=>$request->price,
                        'unit'=>$request->unit,
                        'available_from'=>$availableFrom,
                        'available_to'=>$availableTo,
                        'time' => 1,
                    ]
                );
            }



            DB::commit();
            return $this->respondWithSuccess('Your New Parking Location Successfully Save',[],Response::HTTP_OK);
        }catch (Exception $e)
        {
            DB::rollback();
            return $this->respondWithError('Something Went Wrong !',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


}
