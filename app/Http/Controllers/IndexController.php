<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use DB;
use Str;
use Auth;
use File;
use Helper;

class IndexController extends Controller
{

    public function index()
    {
        $data['firstTwoBlogs'] = DB::table('user_blogs')->where('valid', 1)->orderBy('id', 'ASC')->take(2)->get();
        $data['middleBlogs'] = DB::table('user_blogs')->where('valid', 1)->orderBy('id', 'ASC')->skip(2)->take(1)->get();
        $data['lastTwoBlogs'] = DB::table('user_blogs')->where('valid', 1)->orderBy('id', 'ASC')->skip(3)->take(2)->get();

        $data['recent_posts'] = $recent_posts = DB::table('user_blogs')->where('valid', 1)->orderBy('id', 'DESC')->take(6)->get();

        foreach($recent_posts as $post){
            $post->authorName = DB::table('users')->where('id', $post->gen_user_id)->first()->name;
            $post->authorImage = DB::table('users')->where('id', $post->gen_user_id)->first()->photo_name;
        }

        return view('website.home', $data);
    }

    public function single($id){
        $data['post'] = $post = DB::table('user_blogs')->find($id);
        $data['authorInfo'] = DB::table('users')->where('id', $post->gen_user_id)->first();
        $data['comments'] = $comments = DB::table('user_comments')->where('valid', 1)->where('blog_id', $id)->get();
        foreach($comments as $comment){
            $comment->authorName = DB::table('users')->where('id', $comment->gen_user_id)->first()->name;
            $comment->authorImage = DB::table('users')->where('id', $comment->gen_user_id)->first()->photo_name;
        }

        $data['latest_posts'] = DB::table('user_blogs')->where('valid',1)->orderBy('id', 'DESC')->take(5)->get();
        return view('website.post', $data);
    }

}
