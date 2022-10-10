<?php

namespace App\Http\Controllers\Api\Friend;

use App\Http\Controllers\Controller;
use App\Models\UserSelection;
use Illuminate\Support\Facades\DB;

class FriendOperationController extends Controller {
    public function friendList($user_id) {
        $conected_friend = UserSelection::where('user_id', $user_id)
            ->where('status', '!=', 0)
            ->pluck('friend_id')
            ->toArray();

        $friend = DB::table('users')->whereIn('id', $conected_friend)->get();

        return $friend;
    }
}
