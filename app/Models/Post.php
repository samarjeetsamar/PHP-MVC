<?php

namespace App\Models;
use Core\Model;


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

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }



   
}