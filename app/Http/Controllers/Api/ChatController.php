<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller {
    public function chatList($user_id) {
        $user = DB::table('users')
            ->join('chats', 'users.id', '=', 'chats.friend_id')
            ->where('chats.user_id', '=', $user_id)
            ->select('users.*')
            ->distinct()
            ->get();

        return $user;
    }

    public function storeChat(Request $request) {

        if (Chat::where('user_id', $request->user_id)->where('friend_id', $request->friend_id)->orderBy('id', 'DESC')->first()) {
            $user_id   = $request->user_id;
            $friend_id = $request->friend_id;
            $send_by   = $user_id;
        } elseif (Chat::where('user_id', $request->friend_id)->where('friend_id', $request->user_id)->orderBy('id', 'DESC')->first()) {
            $user_id   = $request->friend_id;
            $friend_id = $request->user_id;
            $send_by   = $friend_id;
        } else {
            $user_id   = $request->user_id;
            $friend_id = $request->friend_id;
            $send_by   = $user_id;
        }

        $chat            = new Chat();
        $chat->user_id   = $user_id;
        $chat->friend_id = $friend_id;
        $chat->send_by   = $send_by;
        $chat->message   = $request->message;
        $chat->save();

        return $chat;
    }

    public function chatDetails($user_id, $friend_id) {

        if (DB::table('chats')->where('user_id', $user_id)->where('friend_id', $friend_id)->orderBy('id', 'DESC')->exists()) {
            $user_id   = $user_id;
            $friend_id = $friend_id;
            $send_by   = $user_id;

            $chat = Chat::where('user_id', $user_id)
                ->where('friend_id', $friend_id)
                ->orderBy('id', 'desc')
                ->with([
                    'user'   => function ($query) {
                        return $query->select(['id', 'name', 'image1']);
                    },
                    'friend' => function ($query) {
                        return $query->select(['id', 'name', 'image1']);
                    },

                ])
                ->paginate(50);
            $unread = DB::table('chats')
                ->where('user_id', $friend_id)
                ->where('friend_id', $user_id)
                ->where('send_by', $send_by)
                ->where('status', 0)
                ->get();

            foreach ($unread as $item) {
                $data = Chat::find($item->id);
                $data->update(['status' => 1]);
            }

        } else {
            $user      = $user_id;
            $user_id   = $friend_id;
            $friend_id = $user;
            $send_by   = $friend_id;

            $chat = Chat::where('user_id', $user_id)
                ->where('friend_id', $friend_id)
                ->orderBy('id', 'desc')
                ->with([
                    'user'   => function ($query) {
                        return $query->select(['id', 'name', 'image1']);
                    },
                    'friend' => function ($query) {
                        return $query->select(['id', 'name', 'image1']);
                    },

                ])->paginate(50);
            $unread = DB::table('chats')
                ->where('user_id', $friend_id)
                ->where('friend_id', $user_id)
                ->where('send_by', $send_by)
                ->where('status', 0)
                ->get();

            foreach ($unread as $item) {
                $data = Chat::find($item->id);
                $data->update(['status' => 1]);
            }

        }

// $chat = DB::table('chats')

//     ->where('user_id', $user_id)

//     ->where('friend_id', $friend_id)

//     ->orderBy('id', 'desc')

//     ->paginate(50);

// $unread = DB::table('chats')

//     ->where('user_id', $friend_id)

//     ->where('friend_id', $user_id)

//     ->where('send_by', $friend_id)

//     ->where('status', 0)

//     ->get();

// foreach ($unread as $item) {

//     $data = Chat::find($item->id);

//     $data->update(['status' => 1]);
        // }

        return $chat;
    }

    public function lastChatDetails($user_id, $friend_id) {
        $chat = DB::table('chats')
            ->where('user_id', $user_id)
            ->where('friend_id', $friend_id)
            ->orderBy('id', 'desc')
            ->first();

        return $chat;
    }

    public function countUnreadMessage($user_id, $friend_id) {
        $unread = DB::table('chats')
            ->where('user_id', $friend_id)
            ->where('friend_id', $user_id)
            ->where('send_by', $friend_id)
            ->where('status', 0)
            ->count();

        return $unread;
    }

}
