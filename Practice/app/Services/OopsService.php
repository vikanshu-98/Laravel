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
    public static function getSum($a,$b){
        echo "\n multiply is \n";
        echo $a*$b;
    }
}

class ParentClass {
    use SecondTrait;

    function __construct()
    {
        echo "\n This is the parent class \n";
    }
    static function getName(){
        echo "Your name is vikanshu chauhan";
    }
}

class OopsService  extends ParentClass{

    function __construct()
    {
        //parent::__construct();
        echo "\n this is the child class constructor";
        echo "\n";
    }

    function myNmae(){
        self::getName();
    }

    
}

