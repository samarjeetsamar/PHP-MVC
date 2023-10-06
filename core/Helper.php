<?php

namespace Core;


class Helper {
    function generateUrl($routeName, $params = []) {
        $router = new Router(); // Create an instance of your Router class
        return $router->generateURL($routeName, $params);
       
    }
}


   
