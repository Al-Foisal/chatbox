<?php

namespace App\Http\Controllers\Api\Friend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\UserSelection;

class FriendOperationController extends Controller {
    public function friendList($user_id) {
        $conected_friend = UserSelection::where('user_id', $user_id)
            ->where('status', '!=', 0)
            ->pluck('friend_id')
            ->toArray();

        $friend = Post::whereIn('user_id', $conected_friend)
            ->with('images', 'videos', 'comments', 'likes')
            ->orderBy('id', 'desc')
            ->get();

        return $friend;
    }
}
