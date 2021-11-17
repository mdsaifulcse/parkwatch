<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PointNotificationResourceCollection;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Client;
use App\Models\PointSystem;
use App\Models\UserPointNotification;
use Illuminate\Http\Request;
use DB,MyHelper,Carbon\Carbon,Auth;
use Symfony\Component\HttpFoundation\Response;

class UserPointController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function generatePointGift($notificationId)
    {

        try{

            $pointNotification=UserPointNotification::where(['id'=>$notificationId,'client_id'=>auth()->user()->id])->first();

            if (empty($pointNotification))
            {
                return $this->respondWithError('No Point Data Found',[],Response::HTTP_NOT_FOUND);
            }

            if ($pointNotification->status==UserPointNotification::READ)
            {
                return $this->respondWithError('!Sorry Point Already Added',[],Response::HTTP_CONFLICT);
            }

            $shuffledPoints= $this->shuffle_assoc([5,5,5,5,5,5,5,5,5,10,10,20]);

            return $this->respondWithSuccess('Point Reward Gifts Box ',

                [
                    'id'=>$pointNotification->id,
                    'action_name'=>str_replace('_',' ',$pointNotification->action_name),
                    'point_gift'=>$shuffledPoints
                ]
                ,Response::HTTP_OK);

        }catch (\Exception $e)
        {
            return $this->respondWithError('Something Went Wrong !',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


   public function shuffle_assoc($list) {
        if (!is_array($list))
            return $list;

        $keys = array_keys($list);
        shuffle($keys);
        $random = array();
        foreach ($keys as $key) {
            $random[$key] = $list[$key];
        }
        return $random;
    }

   public function getUserWisePointNotification($clientId=null)
    {
        if (is_null($clientId))
        {
            $clientId=auth()->user()->id;
        }

        try{

            $myPointNotifications=UserPointNotification::where(['client_id'=>$clientId,'status'=>UserPointNotification::UNREAD])->orderBy('id','DESC')->orderBy('status',UserPointNotification::UNREAD)->paginate(2);

            return $this->respondWithSuccess('Parking S ',PointNotificationResourceCollection::make($myPointNotifications),Response::HTTP_OK);

        }catch (\Exception $e)
        {
            return $this->respondWithError('Something Went Wrong !',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $actionNameMustBe=implode(',',UserPointNotification::ACTIONNAME);
        $validateFields=[
            'id' => 'required|exists:user_point_notifications,id',
            'point' => 'required|integer|between:1,20',
        ];

        $validateResponse=$this->respondWithValidation($request->all(),$validateFields);

        if ($validateResponse!='pass')
        {
            return $this->respondWithError('Validation Fail, ',$validateResponse,Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $clientId=auth()->user()->id;

        DB::beginTransaction();
        try{
            $pointNotification=UserPointNotification::where(['id'=>$request->id,'client_id'=>$clientId])->first();

            if (empty($pointNotification))
            {
                return $this->respondWithError('No Point Data Found',[],Response::HTTP_NOT_FOUND);
            }

            if ($pointNotification->status==UserPointNotification::READ)
            {
                return $this->respondWithError('!Sorry Point Already Added',[],Response::HTTP_CONFLICT);
            }

            $pointValue=$request->point;

            $pointNotification->update([
                    'status'=>UserPointNotification::READ,
                    'point'=>$pointValue,
                ]);


            $myTotalPoint=$this->calculateUserTotalPoint($clientId,$pointValue);

            $pointSystem=$this->getPointSystemData($myTotalPoint);


            $badge=$pointSystem->badge_name;
            $badgeIcon=asset($pointSystem->badge_icon);

            DB::commit();
            return $this->respondWithSuccess(' Point Added Successfully ',
                [
                    'total_point'=>$myTotalPoint,
                    'badge_content'=>'Points & a '.$badge.' Badge',
                    'badge_icon'=>$badgeIcon
                ],
                Response::HTTP_OK);

        }catch (Exception $e)
        {
            DB::rollback();
            return $this->respondWithError('Something Went Wrong !, ',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function calculateUserTotalPoint($clientId,$pointValue)
    {
        $clientData=Client::where(['id'=>$clientId])->first();

        $myTotalPoint=$clientData->my_point+$pointValue;
        $clientData->update(['my_point'=>$myTotalPoint]);
        return $myTotalPoint;
    }

    public function getPointSystemData($myTotalPoint)
    {
        if ($myTotalPoint<=100000 && $myTotalPoint>=0)
        {
            $pointSystem=PointSystem::where(['min_point'=>0,'max_point'=>'100000'])->first();

        }
        elseif($myTotalPoint<=300000 && $myTotalPoint>=100001)
        {
            $pointSystem=PointSystem::where(['min_point'=>100001,'max_point'=>'300000'])->first();
        }
        elseif ($myTotalPoint<=500000 && $myTotalPoint>=300001)
        {
            $pointSystem=PointSystem::where(['min_point'=>300001,'max_point'=>'500000'])->first();
        }
        elseif ($myTotalPoint<=700000 && $myTotalPoint>=500001)
        {
            $pointSystem=PointSystem::where(['min_point'=>500001,'max_point'=>'700000'])->first();
        }
        else
        {
            $pointSystem=PointSystem::where(['min_point'=>700001])->first();
        }

        return $pointSystem;

    }

    public function savePointNotification(Request $request)
    {

        $actionNameMustBe=implode(',',UserPointNotification::ACTIONNAME);
        $validateFields=[
            'action_name' => 'required|in:'.$actionNameMustBe,
        ];

        $validateResponse=$this->respondWithValidation($request->all(),$validateFields);

        if ($validateResponse!='pass')
        {
            return $this->respondWithError('Validation Fail, ',['original'=>['action_name must be one among: '.$actionNameMustBe]],Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $id=auth()->user()->id;
        try{
            UserPointNotification::create([
                'client_id'=>$id,
                'action_name'=>$request->action_name,
                'status'=>UserPointNotification::UNREAD,
            ]);


            return $this->respondWithSuccess(' Point Notification Added Successfully ',[],Response::HTTP_OK);

        }catch (\Exception $e)
        {
            return $this->respondWithError('Something Went Wrong !, ',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserPointNotification  $userPoint
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserPointNotification  $userPoint
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPointNotification $userPoint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserPointNotification  $userPoint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserPointNotification $userPoint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserPointNotification  $userPoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPointNotification $userPoint)
    {
        //
    }
}
