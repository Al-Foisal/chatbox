<?php

namespace App\Http\Controllers\Api\Friend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserSelection;
use Illuminate\Http\Request;

class UserSelectionController extends Controller {
    public function us($id) {
        $data = [];

//         $auth = User::find($id);

// // $data['users'] = $users = DB::table('users')->whereNull('otp')->where('id','!=',$id)->pluck('id')->toArray();

//         // return nearest_user($auth->ip, $users);

//         $data['users'] = DB::table('users')->whereNull('otp')->where('id', '!=', $id)->get();

        $data['friends'] = User::where('id', '!=', $id)->get();

        return $data;
    }

    public function userChoiceAs(Request $request) {

        /**
         * whome i have swifted as dislike, like or superlike,
         * checking that before me
         * he/she swifted as dislike, like or superlike me or not.
         */
        $check = UserSelection::where([
            'user_id'          => $request->selected_user_id,
            'selected_user_id' => $request->user_id,
            'friend_id'        => null,
        ])->where('status', '!=', 0)->first();
        $user = User::where('id', $request->selected_user_id)->select('id')->first();

        if ($check) {

            if ($request->status != 0) {
                //making previous swap user as friend
                $check->friend_id = $request->user_id;
                $check->save();

                UserSelection::create([
                    'user_id'          => $request->user_id,
                    'selected_user_id' => $request->selected_user_id,
                    'status'           => $request->status,
                    'friend_id'        => $request->selected_user_id,
                ]);

                return response()->json(['status' => true, 'message' => 'Your swap is matched with previous friend.']);
            } else {

                UserSelection::create([
                    'user_id'          => $request->user_id,
                    'selected_user_id' => $request->selected_user_id,
                    'status'           => $request->status,
                ]);

                return response()->json(['status' => true, 'select_as' => $request->status]);
            }

        } elseif ($user) {

            $select = UserSelection::create([
                'user_id'          => $request->user_id,
                'selected_user_id' => $request->selected_user_id,
                'status'           => $request->status,
            ]);

            return response()->json(['status' => true, 'select_as' => $select->status]);
        } else {
            return response()->json(['status' => false, 'message' => 'Nothing found.']);
        }

    }

    public function approveChoiceUser(Request $request) {
        $us           = UserSelection::find($request->id);
        $us->approved = 1;
        $us->save();

        return response()->json(['status' => true]);
    }

}
