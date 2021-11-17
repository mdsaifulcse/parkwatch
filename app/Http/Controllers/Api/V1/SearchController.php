<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Resources\SearchResource;
use App\Http\Resources\SearchResourceCollection;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Booking;
use App\Models\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use DB,MyHelper;
class SearchController extends Controller
{
    use ApiResponseTrait;

    public function findParkingSpot(Request $request)
    {
        $id=auth()->user()->id;
        try{

            $validateFields=[
                            'location' => 'nullable|max:200',
                            ];

            $validateResponse=$this->respondWithValidation($request->all(),$validateFields);

            if ($validateResponse!='pass')
            {
                return $this->respondWithError('Validation Fail',$validateResponse,Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $parkingSportResult=$this->parkingLotListWithSpaces($request);

            return $this->respondWithSuccess('Parking Search Result ',SearchResourceCollection::make($parkingSportResult),Response::HTTP_OK);

//            $parkingSportResult=Place::with('parkingSpotPrice')
//                ->where('address', 'like','%'.$request->location.'%')->paginate(5);

        }catch (\Exception $e)
        {
            return $this->respondWithError('Something Went Wrong !',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function parkingLotListWithSpaces($request,$parkingId=null)
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
          return  $lots=$lots->where('p.id', $parkingId)->groupBy("p.id")->first();
        }else{

           return $lots=$lots->where('address', 'like','%'.$request->location.'%')
                ->groupBy("p.id")->paginate(20);
        }



    }

    public function findParkingSpotByParkingId($parkingId)
    {
        $id=auth()->user()->id;
        try{


            $parkingSportResult =$this->parkingLotListWithSpaces('',$parkingId);

            if (empty($parkingSportResult))
            {
                return $this->respondWithError('No Data Found !',[],Response::HTTP_NOT_FOUND);
            }

            return $this->respondWithSuccess('Parking Search ',New SearchResource($parkingSportResult),Response::HTTP_OK);

        }catch (\Exception $e)
        {
            return $this->respondWithError('Something Went Wrong !',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
