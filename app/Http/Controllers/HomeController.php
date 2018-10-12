<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $posts= Post::paginate(5);
        $categories = Category::all();

        return view('front/home', compact('posts', 'categories'));
    }

    public function post($id){


        $post = Post::findOrFail($id);
        $categories = Category::all();

        $comments = $post->comments()->whereIsActive(1)->get();

        return view('post', compact('post', 'comments', 'categories'));
    }





}
