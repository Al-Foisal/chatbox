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

        $data['friends'] = User::where('id','!=',$id)->get();

        return $data;
    }

    public function userChoiceAs(Request $request) {
        $check = UserSelection::where([
            'user_id'          => $request->user_id,
            'selected_user_id' => $request->selected_user_id,
        ])->first();
        $user = User::where('id', $request->selected_user_id)->select('id')->first();

        if ($check) {
            return response()->json(['status' => false]);
        } elseif ($user) {

            $select = UserSelection::create([
                'user_id'          => $request->user_id,
                'selected_user_id' => $request->selected_user_id,
                'status'           => $request->status,
            ]);
        } else {
            return response()->json(['status' => false]);
        }

        return response()->json(['status' => true, 'select' => $select]);
    }

    public function approveChoiceUser(Request $request) {
        $us           = UserSelection::find($request->id);
        $us->approved = 1;
        $us->save();

        return response()->json(['status' => true]);
    }

}
