<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //indexメソッド
    public function index()
    {
        $list = DB::table('posts')->get();
        return view('posts.index', ['lists' => $list]);
    }

    public function createForm()
    {
        return view('posts.createForm');
    }

    public function create(Request $request)
    { //POSTでフォームから送られる値は()に2つ値が入り、＄req変数に値が渡される
        $post = $request->input('newPost');
        //リクエストの中の、キーがnewPostと指定されている値をpostとしてテーブルのinsertに使用することになる
        DB::table('posts')->insert([
            'user_name' => Auth::user()->name,
            'contents' => $post
        ]);


        // $request->validate(
        //     [
        //         'contents' => ['required', 'max:150']
        //     ],
        //     [
        //         'contents.max' => '150文字以内でご入力ください。'
        //     ]
        // );

        return redirect('/index');
    }

    public function postlogin()
    {
        // ログインしていたら、indexを表示
        if (Auth::check()) {
            return view('/index');
        } else {
            // ログインしていなかったら、Login画面を表示
            return view('/login');
        }
    }

    public function updateForm($id)
    {
        $post = DB::table('posts')
            ->where('id', $id)
            ->first();
        return view('posts.updateForm', ['post' => $post]);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $up_post = $request->input('upPost');
        DB::table('posts')
            ->where('id', $id)
            ->update(
                ['contents' => $up_post]
            );
        return redirect('/index');
    }

    public function delete($id)
    {
        DB::table('posts')
            ->where('id', $id)
            ->delete();
        return redirect('/index');
    }

    public function someControllerMethod()
    {
        // ログイン中のユーザーのIDを取得
        $userId = Auth::id();
        // ログイン中のユーザーのユーザーネームを取得
        $userName = Auth::name();

        // ...

        return view('/index', ['userId' => $userId, 'userName' => $userName]);
    }
}
