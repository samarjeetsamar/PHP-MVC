<?php
namespace App\Services;

class PostService{

    public static function generateSlug($title){
        return strtolower(str_replace(' ', '_', $title)) ;
    }
}