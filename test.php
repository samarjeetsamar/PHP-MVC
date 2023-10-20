<?php
include_once 'core\Session.php';

//use Core\Session;

class Test  {

    

    public function setSession($key, $value){
        return Core\Session::put($key, $value);
    }

    public function getSession(){
        return Core\Session::get('success');
    }

    public function flashMessage($key, $value = null)  {
        return Core\Session::flash($key, $value);
    }


}

$objTest = new Test;



$objTest->setSession('success', 'hi from success');
$objTest->setSession('error', 'hi from error');

echo $objTest->getSession('error');
echo "<br>";

echo $objTest->getSession('sucess');

 $objTest->flashMessage('success', 'hi from flash message!!!');
echo $objTest->flashMessage('success');