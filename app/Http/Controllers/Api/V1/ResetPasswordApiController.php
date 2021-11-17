<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResetPasswordResource;
use App\Http\Resources\UserResource;
use App\Mail\PasswordResetOptMail;
use App\Models\Client;
use App\User;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;
use DB,MyHelper,Carbon\Carbon,Auth;
class ResetPasswordApiController extends Controller
{
    use ApiResponseTrait;


    public function changeMyPassword(Request $request)
    {

        $validateFields=[
            'driveway' => 'required|in:Yes,No',
            'current_password' => ['required'],
            'new_password' => 'required|min:6',
            'new_confirm_password' => 'same:new_password',
        ];

        $validateResponse=$this->respondWithValidation($request->all(),$validateFields);

        if ($validateResponse!='pass')
        {
            return $this->respondWithError('Validation Fail',$validateResponse,Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try{

//            $validDate=$userData->otp_validity;
//            $validDate=New Carbon($validDate);
//
//            if ($userData->otp_status==User::NOT_VERIFIED || !$validDate->gt(Carbon::now()))
//            {
//                return $this->respondWithError('You have entered invalid Otp','',Response::HTTP_CONFLICT);
//            }
            if ($request->driveway=='Yes')
            {
                $guard=$this->userApi();
                $logUserData=User::where(['id'=>auth($guard)->user()->id])->first();
            }else{
                $guard='api';
                $logUserData=Client::where(['id'=>auth($guard)->user()->id])->first();
            }


            if (Hash::check($request->current_password, auth($guard)->user()->password)==false)
            {
                return $this->respondWithError('Current password does not match',[],Response::HTTP_CONFLICT);
            }



            $logUserData->update(['password'=> Hash::make($request->new_password)]);

            return $this->respondWithSuccess('Your Password Successfully Change',[],Response::HTTP_OK);

        }catch (Exception $e)
        {
            $bug=$e->errorInfo[1];
            return $this->respondWithError('Something Went Wrong !',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }



    public function verifyOtpAndResetPassword(Request $request)
    {

        $validateFields=[
            'driveway' => 'required|in:Yes,No',
            'email'=> "required",
            'password_reset_otp'=> "required",
            'new_password' => 'required|min:6',
            'new_confirm_password' => 'same:new_password',
        ];

        $validateResponse=$this->respondWithValidation($request->all(),$validateFields);

        if ($validateResponse!='pass')
        {
            return $this->respondWithError('Validation Fail',$validateResponse,422);
        }


        try{

            //date_default_timezone_set('Asia/Dhaka');

            if ($request->driveway=='Yes')
            {

                $userOtpData=User::where(['email'=>$request->email,'password_reset_otp'=>$request->password_reset_otp])->first();
            }else{

                $userOtpData=Client::where(['email'=>$request->email,'password_reset_otp'=>$request->password_reset_otp])->first();
            }



            if (empty($userOtpData))
            {
                return $this->respondWithError('Your given otp does not match !','',Response::HTTP_UNPROCESSABLE_ENTITY);
            }



            $validDate=$userOtpData->otp_validity;
            $validDate=New Carbon($validDate);
            //return date('d-M-Y h:i:s',strtotime(Carbon::now()));

            if ( $validDate->lt(Carbon::now()))
            {
                return $this->respondWithError('Your given otp has been expired','',Response::HTTP_UNAUTHORIZED);

            }else{

                $userOtpData->update(
                    [
                    'password'=> Hash::make($request->new_password),
                    'password_reset_otp'=>'',
                    'otp_validity'=>'',
                    'otp_status'=>Client::OTP_VERIFIED
                    ]);

                return $this->respondWithSuccess('Your Password Successfully Reset',[],Response::HTTP_OK,'');
            }


        }catch (\Exception $e)
        {
            return $this->respondWithError('Something Went Wrong !',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    public function getResetPasswordOptToEmail(Request $request)
    {

        $validateFields=[
            'email'=> "required",
            'driveway' => 'required|in:Yes,No',
        ];

        $validateResponse=$this->respondWithValidation($request->all(),$validateFields);

        if ($validateResponse!='pass')
        {
            return $this->respondWithError('Validation Fail',$validateResponse,422);
        }

        try{

            if ($request->driveway=='Yes')
            {
                $userData=User::where(['email'=>$request->email])->first();
            }else{

                $userData=Client::where(['email'=>$request->email])->first();
            }


            if (empty($userData))
            {
                return $this->respondWithError('No data found by this email!','',Response::HTTP_NOT_FOUND);
            }

            if ($request->driveway=='Yes')
            {
                $name=$userData->name;
            }else{

                $name=$userData->first_name.' '.$name=$userData->last_name;
            }




            $digits = 6;
            $newOtp = rand(pow(10, $digits-1), pow(10, $digits)-1);

            $userOtp['password_reset_otp'] = $newOtp;
            $userOtp['email'] = $request->email;
            $otpValidity=Carbon::now()->addMinutes(10);

            $userData->update([
                    'password_reset_otp'=>$newOtp,
                    'otp_validity'=>$otpValidity,
                    'otp_status'=>Client::OTP_NOT_VERIFIED
                ]);

            $otpValidity=date(' h:iA Y-m-d',strtotime($otpValidity));

            $optData['name']=$name;
            $optData['otp']=$newOtp;
            $optData['expired_at']=$otpValidity;


            Mail::to($request->email)->send(New PasswordResetOptMail($optData) );

            return $this->respondWithSuccess('New Forgot Otp Send to '.$request->email, ['otp'=>$newOtp,'Expired At'=>$otpValidity,'name'=>$name],Response::HTTP_CREATED);

        }catch (Exception $e)
        {

            return $this->respondWithError('Something Went Wrong !',$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
