<?php

namespace App\Traits;

trait ApiTrait
{

    public function getCurrentLang()
    {
        return app()->getLocale();
    }



    public function returnSuccessMessage($code, $msg)
    {
        return response()->json([
            'status' => true,
            'msg' => $msg,
        ], $code);
    }

    public function returnData($msg, $value, $code)
    {
        return response()->json([
            'status' => true,
            'msg' => $msg,
            'data' => $value,
        ], $code);
    }

    public function returnError($code, $msg)
    {
        return response()->json([
            'status' => false,
            'msg' => $msg,
        ], $code);
    }

    public function returnValidationError($code, $validator)
    {
        return $this->returnError($code, $validator->errors()->first());
    }

    // $lang = $this->getCurrentLang();
    //   app()->setLocale('ar');

}