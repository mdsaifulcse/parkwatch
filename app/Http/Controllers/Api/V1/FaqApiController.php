<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Faq;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FaqApiController extends Controller
{
    use ApiResponseTrait;

    public function getActiveFaqTermPolicy($type=null)
    {
        if (is_null($type))
        {
            $type=Faq::FAQ;
        }

        $faqs=Faq::where(['status'=>Faq::PUBLISHED,'type'=>$type])->orderBy('id','DESC')->get();

        return $this->respondWithSuccess(str_replace('_',' ',$type).' Data Retried',$faqs,Response::HTTP_OK);
    }
}
