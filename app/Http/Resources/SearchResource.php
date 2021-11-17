<?php

namespace App\Http\Resources;

use App\Models\Booking;
use Illuminate\Http\Resources\Json\Resource;

class SearchResource extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'type'=>$this->type,
            'name'=>$this->name,
            'address'=>$this->address,
            'available_from'=>$this->available_from,
            'available_to'=>$this->available_to,
            'latitude'=>$this->latitude,
            'longitude'=>$this->longitude,
            'geolocation'=>$this->geolocation,
            'is_price'=>$this->is_price,
            'time'=>$this->time,
            'unit'=>$this->unit,
            'price'=>$this->price,
            'total_space'=>$this->limit,
            'occupied'=>$this->bookingData($this->id)>0?$this->bookingData($this->id):0,
            'available'=>$this->limit-$this->bookingData($this->id),
        ];
    }


    public function bookingData($placeId)
    {

       return $occupied=Booking::where('booking_status', '=', '0')
            ->where('place_id', $placeId)
            ->groupBy('booking_status')
            ->count();



    //   'total_space' => $lot->limit,
    //   'occupied'    => $occupied,
    //   'available'   => ($lot->limit-$occupied),


    }

}
