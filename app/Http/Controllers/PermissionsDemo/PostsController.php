<?php

namespace App\Http\Controllers\PermissionsDemo;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{

    public  function __construct()
    {
        $this->middleware('admin');
//        $this->middleware('admin',['only'=>['store']]);
    }

    //
    public function show($id)
    {

        $post = Post::findOrFail($id);

        Auth::loginUsingId(1);

//        $this->authorize('edit_from',$post);
        //或者

//        if(Gate::denies('edit_from', $post)){
//            abort(403,'sorry');
//        }
//        return $post->title;

        return view('posts.show',compact('post'));
    }



}
