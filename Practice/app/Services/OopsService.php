<?php
 namespace App\Services;

trait FirstTrait{
    function getSum($a,$b){
        echo "\n trait \n";
        echo "The sum is";
        echo  $a+$b;
        echo "\n";
    }
}

trait SecondTrait{
    private function getSum($a,$b){
        echo "\n multiply is \n";
        echo $a*$b;
    }
}

class ParentClass {
    use SecondTrait,FirstTrait{
        FirstTrait::getSum insteadOf SecondTrait;
       //SecondTrait::getSum insteadOf FirstTrait;
       secondTrait::getSum as public getMultiply;
    }

    function __construct()
    {
        echo "\n This is the parent class \n";
    }
}

class OopsService  extends ParentClass{

    function __construct()
    {
        //parent::__construct();
        echo "\n this is the child class constructor";
        echo "\n";
    }

    
}

