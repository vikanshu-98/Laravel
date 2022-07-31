<?php

namespace App\Exceptions;

use App\Macros\ResponseMacros;
use Exception;

class AppException extends Exception{

    protected $message;
    public function __construct(string $message='Exception',$httpCode=200){
        $this->message = $message;
        $this->httpCode = $httpCode;
    }

    public function report(){

    }
    public function render(){ 
        return response()->ApiException($this,$this->message,$this->httpCode);
    }
}