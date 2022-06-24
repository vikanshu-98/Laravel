<?php


namespace App\Services;
class FirstServices{

public $transactionId;

public function __construct($transactionId)
{
    $this->transactionId = $transactionId;
}


    public function returnArray(){
        return [
            'name'=>'vikans',
            'transaction'=> $this->transactionId
        ];
    }
}

?>