<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class FollowsController extends Controller
{
    //
    public function followList(){
        $followIcons = DB::table('users')
            ->join('follows', 'users.id', '=', 'follows.follow')
            ->where('follows.follower', Auth::id())
            ->select('users.id', 'users.images')
            ->get();
        $followPosts = DB::table('users')
            ->join('posts','users.id', '=' ,'posts.user_id')
            ->join('follows', 'users.id', '=', 'follows.follow')
            ->where('follows.follower', Auth::id())
            ->select('users.id', 'users.username', 'users.images', 'posts.posts', 'posts.created_at')
            ->get();

        return view('follows.followList', compact('followIcons','followPosts'));
    }
    public function followerList(){
        $followerIcons = DB::table('users')
            ->join('follows', 'users.id', '=', 'follows.follower')
            ->where('follows.follower', Auth::id())
            ->select('users.id', 'users.images')
            ->get();
        $followerPosts = DB::table('users')
            ->join('posts','users.id', '=' ,'posts.user_id')
            ->join('follows', 'users.id', '=', 'follows.follower')
            ->where('follows.follower', Auth::id())
            ->select('users.id', 'users.username', 'users.images', 'posts.posts', 'posts.created_at')
            ->get();
        return view('follows.followerList', compact('followerIcons','followerPosts'));
    }

    public function follow(Request $request){

        $follow = $request->input('id');
        //dd($follow);//
        DB::table('follows')->insert([
            'follow' => $follow,
            'follower' => Auth::id(),
            'created_at' => now()
        ]);
        return back();
    }

    public function unfollow(Request $request){
        //dd($follow);//
        $follow = $request->input('followId');
        DB::table('follows')
            ->where('follow', $follow)
            ->where('follower',Auth::id())
            ->delete();
        return back();
    }



}
