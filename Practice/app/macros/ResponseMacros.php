<?php
namespace App\Macros;

use Exception;

class ResponseMacros{

   public function success(){
        return function(string $message="success",int $code=1000){
            return $this->json(['success'=>true,'code'=>$code,'message'=>$message]);
        };
    }

    public function data(){
        return function(array $data=[],$message="success",int $code=1000){
           
            return $this->json(['success'=>true,'code'=>$code,'message'=>$message,'data'=>$data]);
        };
    }
    

    public function ApiException(){
        return function(Exception $exception,$errors=[],$error_code=1400,$http_code=200){
            if(!empty($error_code)) $http_code=$error_code;
            return $this->json(['success'=>false,'code'=>$error_code,'message'=>$exception->getMessage()],$http_code);
        };
    }
}
