<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Resources\SearchResource;
use App\Http\Resources\SearchResourceCollection;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Booking;
use App\Models\Place;
use App\Models\Price;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use DB,MyHelper;
class BookingApiController extends Controller
{
    use ApiResponseTrait;

    public function storeBookingOrder(Request $request)
    {
        $id=auth()->user()->id;

        $validateFields=[
            'place_id' => 'required|exists:place,id',
            'arrival_time' => 'required|date',
            'booking_period' => 'required|numeric|between:1,200',
        ];

        $validateResponse=$this->respondWithValidation($request->all(),$validateFields);

        if ($validateResponse!='pass')
        {
            return $this->respondWithError('Validation Fail',$validateResponse,Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        DB::beginTransaction();
        try{

            $parkingSport=$this->parkingLotListWithSpaces('',$request->place_id);

            $spotWiseBookCount=Booking::where(['place_id'=>$parkingSport->id,'payment_type'=>Booking::PAID,'booking_status'=>Booking::BOOKED])->count();

            if ($parkingSport->limit<=$spotWiseBookCount)
            {
                return $this->respondWithError('Parking Spot Already Limit Out',[],Response::HTTP_UNPROCESSABLE_ENTITY);
            }


            $departureTime=$this->departureTimeCalculate($request,$parkingSport->unit);
            $netPrice=$this->netPriceCalculation($request,$parkingSport);


            $bookingData=[

                'id_no'=>$this->newTokenNo(),
                'client_id_no'=>auth()->user()->vehicleInfo->licence,
                'vehicle_licence'=>auth()->user()->vehicleInfo->licence,
                'place_id'=>$parkingSport->id,
                'price_id'=>$parkingSport->price_id,
                'space'=>1,
                'arrival_time'=>$request->arrival_time?date('Y-m-d h:i',strtotime($request->arrival_time)):null,
                'departure_time'=>$departureTime,
                'booking_period'=>$request->booking_period,
                'unit'=>$parkingSport->unit,
                'unit_price'=>$parkingSport->price,
                'net_price'=>$netPrice,
                'discount'=>$request->discount,
                'vat'=>0,
                'fine'=>0,
                'total_price'=>$netPrice-$request->discount,
                'created_by'=>$id,
                'payment_type'=>Booking::UNPAID,
                'booking_status'=>Booking::BOOKREQUEST,

            ];
            Booking::create($bookingData);


            DB::commit();
            return $this->respondWithSuccess('Your Parking Spot Booked Successfully ',$bookingData,Response::HTTP_OK);

        }catch (\Exception $e)
        {
            DB::rollback();
            return $this->respondWithError('Something Went Wrong !',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function netPriceCalculation($request,$parkingSport)
    {

        $netPrice=0;
        if ($parkingSport->time==1)
        {
            $netPrice= $parkingSport->price*$request->booking_period;

        }else{

            if ($parkingSport->price>0)
            {
                $price=$parkingSport->price/$parkingSport->time;
                $netPrice=$price*$request->booking_period;
            }
        }

        return $netPrice;
    }


    public function departureTimeCalculate($request,$priceUnit)
    {
        $bookingPeriod=$request->booking_period;
        $departureTime= New Carbon($request->arrival_time);

        if ($priceUnit==Price::MINUTE)
        {
            $departureTime->addMinute($bookingPeriod);
        }
        elseif ($priceUnit==Price::HOUR)
        {
            $departureTime->addHour($bookingPeriod);
        }
        elseif ($priceUnit==Price::DAY)
        {
            $departureTime->addDay($bookingPeriod);
        }
        elseif ($priceUnit==Price::MONTH)
        {
            $departureTime->addMonth($bookingPeriod);
        }
        elseif ($priceUnit==Price::YEAR)
        {
            $departureTime->addYear($bookingPeriod);
        }


       return $departureTime->format('Y-m-d h:i');
    }


    public function newTokenNo()
    {
        $lastTokenNo = Booking::orderBy('id_no','desc')
            ->value('id_no');

        $lastTokenNo = (!empty($lastTokenNo)?$lastTokenNo:'A000000');

        $letter = $lastTokenNo[0];
        $number = $lastTokenNo[1].$lastTokenNo[2].$lastTokenNo[3].$lastTokenNo[4].$lastTokenNo[5].$lastTokenNo[6];

        if ($number < 999999) {
            $newTokenNo = $letter.sprintf("%06d", $number+1);
        } else {
            $ascii = ord($letter);
            $newLetter = chr($ascii+1);
            $newTokenNo = $newLetter.'000001';
        }
        return $newTokenNo;
    }



    public function parkingLotListWithSpaces($request,$parkingId=null)
    {

        $lots = DB::table("place AS p")
            ->select(
                'p.id','p.type','p.name','p.address','p.available_from',
                'p.available_to','p.latitude','p.longitude','pr.time',
                'pr.unit','pr.price','pr.id as price_id','p.limit',
                DB::raw('CONCAT(p.id ,",", p.latitude, "," ,p.longitude) AS geolocation'),

                DB::raw('CASE WHEN COUNT(pr.place_id)>0 THEN True ELSE False END AS is_price')
            )
            ->join("price AS pr", "pr.place_id", "=", "p.id")
            ->where('p.status', 1);



        if (!is_null($parkingId))
        {
            return  $lots=$lots->where('p.id', $parkingId)->groupBy("p.id")->first();
        }else{

            return $lots=$lots->where('address', 'like','%'.$request->location.'%')
                ->groupBy("p.id")->paginate(5);
        }


    }



}
