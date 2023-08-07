<?php
function myHelperFunction()
{
    return "Hello, I'm a helper function!";
}

function showResult($data){
    if(is_array($data) || is_object($data)){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }else{
        echo $data;
    }
}