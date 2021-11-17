<?php

namespace App\Http\Traits;
use Validator;
use Illuminate\Http\Response;
trait ApiResponseTrait
{

    public function login()
    {
        $credentials = request(['phone', 'password']);

        if (! $token = auth('api')->attempt($credentials))
        {
            return $this->respondWithError('Credential does not match !',[],Response::HTTP_UNAUTHORIZED);
        }

        return $this->respondWithToken($token);
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'success' => true,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ],Response::HTTP_OK)->setStatusCode(422);
    }


    protected function respondWithSuccess($message='', $data=[],$code = Response::HTTP_OK,$token='')
    {

        if ($token=='') {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data,
                'code' => $code
            ],$code);
        }else{
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data,
                'code' => $code,
                'token'=>$token
            ],$code);
        }
    }

    protected function respondWithError($message='',$data=[],$code='')
    {
        return response()->json([
            'success'=>false,
            'message'=>$message,
            'data'=>$data,
            'code'=>$code,
        ], $code);
    }


    protected function respondWithValidation($data,$rules,$code=Response::HTTP_UNPROCESSABLE_ENTITY)
    {
        $validator = Validator::make($data, $rules);

        if ($validator->passes()) {
            return 'pass';
        }
        return response()->json($validator->getmessagebag()->all(),$code);
    }

    protected function noDataFoundException($message='',$data=[],$code=Response::HTTP_NOT_FOUND)
    {
        return response()->json([
            'success'=>false,
            'message'=>$message,
            'data'=>$data,
            'code'=>$code
        ],$code);
    }
    protected function alreadyExists($message='',$data=[],$code=Response::HTTP_CONFLICT)
    {
        return response()->json([
            'success'=>false,
            'message'=>$message,
            'data'=>$data,
            'code'=>$code
        ],$code);
    }

    protected function userApi()
    {
        return 'userApi';
    }

}
