<?php

namespace App\Http\Resources;

use App\Models\Client;
use App\Models\PointSystem;
use Illuminate\Http\Resources\Json\Resource;
use DB;

class MyProfileResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'first_name'=>$this->first_name,
            'last_name'=>$this->last_name,
            'email'=>$this->email,
            'mobile'=>$this->mobile,
            'username'=>$this->username,
            'profile_photo'=>!empty($this->profile_photo)?url('/'.$this->profile_photo):'',
            'working_address'=>$this->working_address,
            'home_address'=>$this->home_address,
            'parking_start_date'=>!empty($this->parking_start_date)?date('Y-m-d',strtotime($this->parking_start_date)):'',
            'parking_end_date'=>!empty($this->parking_end_date)?date('Y-m-d',strtotime($this->parking_end_date)):'',
            'vehicle_type_id'=>!empty($this->vehicleInfo->vehicleType)?$this->vehicleInfo->vehicleType->id:'',
            'car_size'=>!empty($this->vehicleInfo->vehicleType)?$this->vehicleInfo->vehicleType->name:'',
            'vehicle_type'=>!empty($this->vehicleInfo)?$this->vehicleInfo->vehicle_type:'',
            'make'=>$this->vehicleInfo->make,
            'model'=>$this->vehicleInfo->model,
            'color'=>$this->vehicleInfo->color,
            'licence'=>$this->vehicleInfo->licence,
            'parking_interest'=>$this->clientParkingInterest->pluck('parking_interest'),
            'parking_buddy_radius'=>$this->parking_buddy_radius,
            'my_total_point'=>$this->my_point,
            'my_rank'=>$this->myRankCalculate(),
            'badge_icon'=>$this->getPointSystemData($this->my_point),
            'point_rank'=>Client::select('my_point as points',DB::raw("CONCAT(first_name,' ', last_name) AS nickname"))->orderBy('my_point','DESC')->take(10)->get(),
        ];

        //return parent::toArray($request);
    }

    public function myRankCalculate()
    {
        $clientPoints=Client::orderBy('my_point','DESC')->get(['my_point','id']);

        $myRank=0;
        foreach ($clientPoints as $key=>$clientPoint)
        {
            if ($clientPoint->id==auth()->user()->id)
            {
                $myRank=$key+1;
                break;
            };
        }

        return $myRank;
    }

    public function getPointSystemData($myTotalPoint)
    {
        $pointSystem='';
        if ($myTotalPoint<=100000 && $myTotalPoint>=0)
        {
            $pointSystem=PointSystem::where(['min_point'=>0,'max_point'=>'100000'])->value('badge_icon');

        }
        elseif($myTotalPoint<=300000 && $myTotalPoint>=100001)
        {
            $pointSystem=PointSystem::where(['min_point'=>100001,'max_point'=>'300000'])->value('badge_icon');
        }
        elseif ($myTotalPoint<=500000 && $myTotalPoint>=300001)
        {
            $pointSystem=PointSystem::where(['min_point'=>300001,'max_point'=>'500000'])->value('badge_icon');
        }
        elseif ($myTotalPoint<=700000 && $myTotalPoint>=500001)
        {
            $pointSystem=PointSystem::where(['min_point'=>500001,'max_point'=>'700000'])->value('badge_icon');
        }
        else
        {
            $pointSystem=PointSystem::where(['min_point'=>700001])->value('badge_icon');
        }

        return $pointSystem;

    }
}
