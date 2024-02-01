<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */

    public function delete(User $user, $id)
    {
        $post = Post::find($id); // 投稿の ID から投稿を取得
        return $user->name === $post->user_name;
    }
}
