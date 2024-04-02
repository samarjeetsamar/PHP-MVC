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
        $post = $postObj->select(['id', 'title', 'body'])->where('slug', '=', $slug)->first();
        $metadata['title'] = $post->title;
        $metadata['description'] = $post->body;
        $metadata['keywords'] = $post->title;

        View::render('post/single.php', ['post'=>$post, 'metadata' => $metadata]);
       // die;
    }

}