<?php

namespace App\Http\Resources;

use App\Models\UserPointNotification;
use Illuminate\Http\Resources\Json\Resource;

class PointNotificationResource extends Resource
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
            'client_id'=>$this->client_id,
            'status'=>$this->status,
            'action_name'=>$this->action_name,
            'point_reward_url'=>$this->status==UserPointNotification::UNREAD? url('/api/v1/choose-point-gift/'.$this->id) :'',
        ];

        //return parent::toArray($request);
    }
}
