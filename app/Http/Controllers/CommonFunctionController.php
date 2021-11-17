<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Place;
use App\Models\State;
use App\Models\Zone;
use Illuminate\Http\Request;

class CommonFunctionController extends Controller
{

    public function mail(){
        return 'sdf';
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
