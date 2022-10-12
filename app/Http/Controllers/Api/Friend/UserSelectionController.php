<?php

namespace App\Http\Controllers\Api\Friend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserSelection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserSelectionController extends Controller {
    public function us($id) {

        //find authenticated user
        $auth = User::find($id);

//finding authenticated user, and
        //reverse gender of authenticated user
        $reverse_user = DB::table('users')
            ->where('gender', '!=', $auth->gender)
            ->where('id', '!=', $auth->id)
            ->pluck('id')
            ->toArray();

        //matching user
        $selected_user = DB::table('user_selections')
            ->where('user_id', $auth->id)
            ->where('status', '!=', 0)
            ->pluck('selected_user_id')
            ->toArray();

        $user = array_diff($reverse_user, $selected_user);

        $available_user = DB::table('users')
            ->whereIn('id', $user)
            ->orderBy('updated_at', 'DESC')
            ->paginate(50);

        return $available_user;
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

                return response()->json(['status' => true, 'select_as' => '3']);
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
            return response()->json(['status' => false, 'select_as' => '4']);
        }

    }

    public function approveChoiceUser(Request $request) {
        $us           = UserSelection::find($request->id);
        $us->approved = 1;
        $us->save();

        return response()->json(['status' => true]);
    }

}
