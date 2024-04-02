<?php

namespace App\Models;
use App\Models\Model;

class Post extends Model {

    protected $table = 'posts';

    public function create($data){
        try {
            $resp = $this->table($this->table)->insert($data);
            return $resp;
        }catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getAllPosts(){
        $posts = $this->select(['title', 'body', 'slug'])->get();
        return $posts;
    }

   
}