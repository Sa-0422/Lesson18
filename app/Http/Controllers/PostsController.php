<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Post;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

use App\Policies\CommentPolicy;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //indexメソッド
    public function index()
    {
        $list = DB::table('posts')->get();
        return view('posts.index', ['lists' => $list]);
    }

    //検索
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        // 検索ロジックを実装する

        $results = DB::table('posts')
            ->where('contents', 'like', '%' . $keyword . '%')
            ->get();

        return view('posts.index', ['lists' => $results]);
    }

    public function createForm()
    {
        return view('posts.createForm');
    }

    public function create(Request $request)
    { //POSTでフォームから送られる値は()に2つ値が入り、＄req変数に値が渡される

        // カスタムルール実装
        $this->validate(
            $request,
            [
                'newPost' => 'required|space|max:100',
            ],
            [
                'newPost.space' => 'スペースのみでは投稿できません。',
                'newPost.max' => '100文字以内で投稿してください。',
            ]
        );

        $post = $request->input('newPost');
        //リクエストの中の、キーがnewPostと指定されている値をpostとしてテーブルのinsertに使用することになる
        DB::table('posts')->insert([
            'user_name' => Auth::user()->name,
            'contents' => $post
        ]);

        return redirect('/index');
    }

    // public function postlogin()
    // {
    //     // ログインしていたら、indexを表示
    //     if (Auth::check()) {
    //         return view('/index');
    //     } else {
    //         // ログインしていなかったら、Login画面を表示
    //         return view('/login');
    //     }
    // }

    public function updateForm($id)
    {
        $post = DB::table('posts')
            ->where('id', $id)
            ->first();
        return view('posts.updateForm', ['post' => $post]);
    }

    public function update(Request $request)
    {
        // // バリデーションルール
        // $rules = [
        //     'contents' => [
        //         'required',
        //         'string',
        //         'regex:/[^\x20\xA1-\xFE]/', // 全角スペース以外の文字が1文字以上含まれていることを確認
        //     ],
        // ];

        // // カスタムメッセージ
        // $messages = [
        //     'contents.regex' => 'スペースのみの投稿はできません。',
        // ];

        // // 置き換えたバリデーションを実行
        // $validator = Validator::make($request->all(), $rules, $messages);

        // // バリデーションが失敗した場合
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        //カスタムルール実装
        $this->validate(
            $request,
            [
                'upPost' => 'required|space|max:100',
            ],
            [
                'upPost.space' => 'スペースのみでは投稿できません。',
                'upPost.max' => '100文字以内で投稿してください。',
            ]
        );


        // // バリデーションが成功した場合、投稿処理を実行
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

        // 削除対象の投稿を取得
        $post = Post::find($id);

        // // 削除権限をチェックする
        // $this->authorize('delete', $post);

        // 権限がある場合は削除を実行
        $post->delete();

        return redirect('/index');
    }

    public function someControllerMethod()
    {

        // ログイン中のユーザーのIDを取得
        $userId = Auth::id();
        // ログイン中のユーザーのユーザーネームを取得
        $userName = Auth::name();

        return view('/index', ['userId' => $userId, 'userName' => $userName]);
    }
}
