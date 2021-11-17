<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    use ApiResponseTrait;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:api'], ['except' => ['login','logout','drivewayLogin']]);
        //auth()->setDefaultDriver('userApi');
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validateFields=[
            'email' => 'required',
            'password'  => "required",
        ];

        $validateResponse=$this->respondWithValidation($request->all(),$validateFields);

        if ($validateResponse!='pass')
        {
            return $this->respondWithError('Validation Fail',$validateResponse,Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $credentials = request(['email', 'password']);


        //if ($this->userGuard()->validate($credentials))
        if (auth('api')->validate($credentials))
        {

            //if ( !$token =  $this->userGuard()->attempt($credentials))
            if ( !$token =  $this->guard()->attempt($credentials))
            {
                return $this->respondWithError('Credential does not match !!',[],Response::HTTP_UNAUTHORIZED);
                //return response()->json(['error' => ' Credential does not match !'], 401);
            }


            return $this->respondWithToken($token);

        }else{
            return $this->respondWithError('Credential does not match !.',[],Response::HTTP_UNAUTHORIZED);
           // return response()->json(['error' => ' Credential does not match !'], 401);
        }


//        $credentials = $request->only('email', 'password');
//
//        if ($token = $this->guard()->attempt($credentials)) {
//            return $this->respondWithToken($token);
//        }
//
//        return response()->json(['error' => 'Unauthorized'], 401);
    }


    public function drivewayLogin(Request $request)
    {
        $validateFields=[
            'email' => 'required',
            'password'  => "required",
        ];

        $validateResponse=$this->respondWithValidation($request->all(),$validateFields);

        if ($validateResponse!='pass')
        {
            return $this->respondWithError('Validation Fail',$validateResponse,Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $credentials = request(['email', 'password']);


        if ($this->userGuard()->validate($credentials))
        {

            if ( !$token =  $this->userGuard()->attempt($credentials))
            {
                return $this->respondWithError('Credential does not match !!',[],Response::HTTP_UNAUTHORIZED);
            }

            return $this->respondWithToken($token);

        }else{
            return $this->respondWithError('Credential does not match !.',[],Response::HTTP_UNAUTHORIZED);
        }
    }


    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {

        $this->guard()->logout();
        $this->userGuard()->logout();

        return $this->respondWithSuccess('Successfully logged out',[],Response::HTTP_OK);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'message'=>'Successfully Login ',
            'success'=>true,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60,
            'code'=>Response::HTTP_OK,
        ],Response::HTTP_OK);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard('api');
    }

    public function userGuard()
    {
        return Auth::guard('userApi');
    }
}