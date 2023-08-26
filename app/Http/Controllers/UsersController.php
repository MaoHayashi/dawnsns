<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }

    public function search(Request $request){

        if(request('username')) {
            $keyword = $request->input('username');
            $users = DB::table('users')
                ->where("username",'like',"%".$keyword."%")
                ->select('id', 'username', 'images')
                ->get();
        }else{
            $users = DB::table('users')
            ->where('id', '<>', Auth::id())
            ->select('id', 'username', 'images')
            ->get();
        }
        $followNumbers = DB::table('follows')
            ->where('follower',Auth::id())
            ->get();
        return view('users.search', compact('users','followNumbers'));
    }

    public function otherprofile($id){
        $user = $users = DB::table('users')
            ->where('id', $id)
            ->select('id', 'users.username', 'users.images', 'bio')
            ->first();

        $posts = $posts = DB::table('users')
            ->join('posts', 'users.id', '=', 'posts.user_id')
            ->where('users.id', $id)
            ->select('username','users.images','posts.id', 'posts.user_id','posts.posts','posts.created_at')
            ->get();
            //dd($posts);
        $followNumbers = DB::table('follows')
            ->where('follower',Auth::id())
            ->get();
            return view('users.otherprofile',compact('user','posts', 'followNumbers'));
    }


}
