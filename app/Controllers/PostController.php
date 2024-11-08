<?php 
namespace App\Controllers;

use App\Exceptions\NotFoundException;
use App\Models\Post;
use Core\Redirect;
use Core\Request;
use Core\Validator;

use App\Services\PostService;
use Core\View;
use Core\Facade\Auth;
use Exception;

class PostController {


    public function create(){
        View::render('post/create.php');
    }


    public function store(Request $request){

        if(!Auth::check()){
            Redirect::back()->with('error', 'You must login to create a post!');
        }

        $input = $request->only(['title', 'body']);

        
        $errors = Validator::validate($input, [
            'title' => 'required|min:20',
            'body' => 'required'
        ]);

        if(count($errors)){
            Redirect::back()->withErrors($errors);
        }

        
        $slug = PostService::generateSlug($input['title']);
        $input['slug'] = $slug;
        $input['user_id'] = Auth::user()->id;

        try {
            $postObj = new Post;
            $post = $postObj->create($input);
        }catch(\Exception $e){
            echo $e->getMessage();
            exit;
        }

        Redirect::back()->with('success', 'Post created successfully!');
    }

    public function show($slug){

        
        $postObj = new Post;
        
        $metadata = [];
        $post = $postObj->with('user')->where('slug', '=', $slug)->first();

       // dd($post);

        if($post){
            $metadata['title'] = $post->title;
            $metadata['description'] = $post->body;
            $metadata['keywords'] = $post->title;
        }else {
            throw new NotFoundException('We are sorry for the inconvenience. It looks like you\'re trying to access the page that either has been deleted or never even existed.');

        }

        View::render('post/single.php', ['post'=>$post, 'metadata' => $metadata]);
       // die;
    }

    public function getPostsByUser(){


        $userObj = new \App\Models\User;
        $posts = $userObj->with('posts')->where('users.id', '=', 227)->get();
        dd($posts);

    }

}