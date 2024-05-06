<?php

namespace App\Traits;

trait ApiTrait
{
    public function saveFile($file_request, $path, $oldName = null){
        // save  in folder
        $file = $file_request;
        @unlink(public_path(parse_url($oldName)));
        $file_name = rand(11111111, 99999999). '.' .$file->getClientOriginalExtension();
        $file->move(public_path($path), $file_name);
        return $file_name;
    }

    public function returnError($status=500, $msg='',$value=null){
        return response()->json([
            'status' => $status,
            'message' => $msg,
            'data' => $value

        ], $status);
    }
    public function returnSuccess($status=200, $msg='',$value= null){
        return response()->json([
            'status' => $status,
            'message' => $msg,
            'data' => $value
        ], $status);
    }
    public function returnData($status=200, $msg='' ,$value=null){
        return response()->json([
            'status' => $status,
            'message' => $msg,
            'data' => $value
        ], $status);
    }
    protected function createNewToken($token, $status=201, $msg=''){
        return response()->json([
            'status' => $status,
            'msg' => $msg,
            'access_token' => $token,
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ], $status);
    }

}