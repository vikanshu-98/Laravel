<?php 

if(!function_exists('checkgender')){
    function checkgender($type){
        if($type=="Male"){
            return "M";
        }else if($type=="Female"){
            return "F";
        }else{
            return "O";
        }
    }
}


if(!function_exists('pp')){
    function pp($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        die();
    }
}