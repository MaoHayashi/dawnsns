<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class PostsController extends Controller
{
    //
    public function index(){
        $posts = DB::table('users')
            ->join('posts', 'users.id', '=', 'posts.user_id')
            ->select('users.username', 'users.images', 'posts.id', 'posts.user_id','posts.posts','posts.created_at')
            ->get();
        return view('posts.index', compact('posts'));
    }

    public function create(Request $request){

        $post = $request->input('newPost');
        DB::table('posts')->insert([
            'user_id' => Auth::id(),
            'posts' =>$post,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/top');
    }

    public function delete(Request $request){

        $post = $request->input('postId');
        DB::table('posts')->where('id', $post)->delete();

        return redirect('/top');
    }

    public function update(Request $request){

        $post = $request->input('upPost');
        $update = $request->input('updatePost');
        DB::table('posts')->where('id', $post)->update([
            'posts' => $update,
            'updated_at' => now(),
        ]);

        return redirect('/top');
    }
}
