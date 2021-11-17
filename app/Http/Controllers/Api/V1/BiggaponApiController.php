<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Resources\SearchResourceCollection;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Biggapon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use DB,MyHelper;
class BiggaponApiController extends Controller
{
    use ApiResponseTrait;private $str;

    public function getBiggaponInfo(Request $request)
    {

        $placeMustBe=Biggapon::TOP.','.Biggapon::MIDDLE.','.Biggapon::BOTTOM;
        $validateFields=[
            'place' => 'nullable|in:'.$placeMustBe,
        ];

        $validateResponse=$this->respondWithValidation($request->all(),$validateFields);

        if ($validateResponse!='pass')
        {
            return $this->respondWithError('Validation Fail',['original'=>'Biggapon Place must be one of :'.$placeMustBe],Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try{

            $parkingSportResult=Biggapon::select('id','image','place','status')->
            where(['place'=> $request->place,'status'=>Biggapon::ACTIVE])
                ->inRandomOrder()->orderBy('id','DESC')->first();
            $parkingSportResult['image']=asset($parkingSportResult->image);

            return $this->respondWithSuccess($request->place.' Place Biggapon ',$parkingSportResult,Response::HTTP_OK);

        }catch (Exception $e)
        {
            return $this->respondWithError('Something Went Wrong !',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }




}
