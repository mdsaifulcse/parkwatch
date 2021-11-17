<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Models\AppPreference;
use Illuminate\Http\Request;
use DB,MyHelper,Carbon\Carbon,Auth;
use Symfony\Component\HttpFoundation\Response;

class AppPreferenceController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $preferenceData=AppPreference::where(['client_id'=>auth()->user()->id])->first();


            return $this->respondWithSuccess('App Preference Setting Data',$preferenceData,Response::HTTP_OK);

        }catch (\Exception $e)
        {
            $bug=$e->errorInfo[1];
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
        $validateFields=[
            'sound_voice' => 'nullable|numeric|digits_between:0,1',
            'guidance_volume' => 'nullable|numeric|digits_between:1,10',
            'avoid_highway' => 'nullable|numeric|digits_between:0,1',
            'avoid_toll' => 'nullable|numeric|digits_between:0,1',
            'avoid_ferrie' => 'nullable|numeric|digits_between:0,1',

            'color_schema' => 'nullable|max:15',
            'automatic_day_night' => 'nullable|max:15',
            'distance_unit' => 'nullable||max:15',

            'show_traffic_map' => 'nullable|numeric|digits_between:0,1',
            'show_speed_limit' => 'nullable|numeric|digits_between:0,1',
            'save_parking_location' => 'nullable|numeric|digits_between:0,1',
        ];

        $validateResponse=$this->respondWithValidation($request->all(),$validateFields);

        if ($validateResponse!='pass')
        {
            return $this->respondWithError('Validation Fail',$validateResponse,Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $preferenceInput=[
            'client_id'=>auth()->user()->id,
            'sound_voice'=>empty($request->sound_voice)?0:$request->sound_voice,
            'guidance_volume'=>empty($request->guidance_volume)?0:$request->guidance_volume,
            'avoid_highway'=>empty($request->avoid_highway)?0:$request->avoid_highway,
            'avoid_toll'=>empty($request->avoid_toll)?0:$request->avoid_toll,
            'avoid_ferrie'=>empty($request->avoid_ferrie)?0:$request->avoid_ferrie,

            'color_schema'=>empty($request->color_schema)?AppPreference::Light:$request->color_schema,
            'automatic_day_night'=>empty($request->automatic_day_night)?AppPreference::DAY:$request->automatic_day_night,
            'distance_unit'=>empty($request->distance_unit)?AppPreference::MILES:$request->distance_unit,

            'show_traffic_map'=>empty($request->show_traffic_map)?0:$request->show_traffic_map,
            'show_speed_limit'=>empty($request->show_speed_limit)?0:$request->show_speed_limit,
            'save_parking_location'=>empty($request->save_parking_location)?0:$request->save_parking_location,
        ];

        try{
            $preferenceData=AppPreference::where(['client_id'=>auth()->user()->id])->first();

            if (empty($preferenceData))
            {
                AppPreference::create($preferenceInput);
            }
            else{

                $preferenceData->update($preferenceInput);
            }

            $preferenceData=AppPreference::where(['client_id'=>auth()->user()->id])->first();


            return $this->respondWithSuccess('App Preference Setting Successfully Save',$preferenceData,Response::HTTP_OK);

        }catch (\Exception $e)
        {
            $bug=$e->errorInfo[1];
            return $this->respondWithError('Something Went Wrong !',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppPreference  $appPreference
     * @return \Illuminate\Http\Response
     */
    public function show(AppPreference $appPreference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppPreference  $appPreference
     * @return \Illuminate\Http\Response
     */
    public function edit(AppPreference $appPreference)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppPreference  $appPreference
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppPreference $appPreference)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppPreference  $appPreference
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppPreference $appPreference)
    {
        //
    }
}
