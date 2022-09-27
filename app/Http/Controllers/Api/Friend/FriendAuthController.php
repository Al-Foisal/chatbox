<?php

namespace App\Http\Controllers\Api\Friend;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class FriendAuthController extends Controller {
    public function checkFriend(Request $request) {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric|digits:11',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Invalid phone number!!']);
        }

        $check = User::where('phone', $request->phone)->first();

        if ($check) {
            return response()->json(['otp' => $check->otp]);
        } else {
            $user           = new User();
            $user->name     = 'xyz';
            $user->phone    = $request->phone;
            $user->password = 123;
            $user->otp      = rand(1111, 9999);
            $user->save();

            return response()->json(['otp' => $user->otp]);
        }

    }

    public function otpVerify(Request $request) {
        $user = User::where('phone', $request->phone)->first();

        if ($user && $user->otp === $request->otp) {
            $user->otp = null;
            $user->save();

            return response()->json(['status' => true, 'message' => 'OTP verified!!']);
        }

        return response()->json(['status' => false, 'message' => 'Invalid OTP!']);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'phone'    => 'required|numeric|digits:11',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Invalid phone number!!']);
        }

        if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {

            $user = Auth::user();

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'status'       => true,
                'access_token' => $tokenResult,
                'token_type'   => 'Bearer',
                'user'         => $user,
            ]);
        }

        return response()->json(['status' => false, 'message' => 'No account found!!']);
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'phone'    => 'required|digits:11',
            'password' => 'required',
            'dob'      => 'required',
            'gender'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Validation error1!!']);
        }

        $user = User::where('phone', $request->phone)->where('otp', null)->first();
        if (!$user) {
            return response()->json(['message' => 'Something went wrong!!']);
        }

        if ($request->hasFile('image1')) {

            $image_file = $request->file('image1');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/user/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->emoji    = $request->emoji;
        $user->password = bcrypt($request->password);
        $user->dob      = $request->dob;
        $user->gender   = $request->gender;
        $user->lat      = $request->lat;
        $user->long     = $request->long;
        $user->image1   = $final_name1??'img';
        $user->save();

        return response()->json(['status' => true, 'user' => $user]);
    }

    public function forgotPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false]);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['status' => false, 'message' => 'This email is no longer with our records!!']);
        }

        $token = bin2hex(random_bytes(20));
        DB::table('password_resets')->insert([
            'token'      => $token,
            'email'      => $request->email,
            'created_at' => now(),
        ]);

        $url = url('/friend/reset-password', [$token, 'email' => $request->email]);

        Mail::to($request->email)->send(new ResetPassword($url));

        return response()->json(['status' => true, 'message' => 'We have sent a fresh reset password link!!']);
    }

    public function resetPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|confirmed|min:8', Rules\Password::defaults(),
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Please enter valid information!!']);
        }

        $password = DB::table('password_resets')->where('email', $request->email)->where('token', $request->token)->first();

        if (!$password) {
            return response()->json(['status' => false, 'message' => 'Something went wrong, Invalid token or email!!']);
        }

        $user = User::where('email', $request->email)->first();

        if ($user && $password) {
            $user->password = bcrypt($request->password);
            $user->save();
            DB::table('password_resets')->where('email', $request->email)->delete();

            return response()->json(['status' => true, 'message' => 'New password reset successfully!!']);
        } else {
            return response()->json(['status' => false, 'message' => 'The email is no longer our records!!']);
        }

    }

    public function updateProfile(Request $request) {

        if ($request->hasFile('image1')) {

            $image_file = $request->file('image1');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/user/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name1 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        if ($request->hasFile('image2')) {

            $image_file = $request->file('image2');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/user/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name2 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        if ($request->hasFile('image3')) {

            $image_file = $request->file('image3');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/user/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name3 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        if ($request->hasFile('image4')) {

            $image_file = $request->file('image4');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/user/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name4 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        if ($request->hasFile('image5')) {

            $image_file = $request->file('image5');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/user/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name5 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        if ($request->hasFile('image6')) {

            $image_file = $request->file('image6');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/user/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_name6 = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        $user            = User::find($request->user_id);
        $user->name      = $request->name;
        $user->email      = $request->email;
        $user->dob       = $request->dob;
        $user->emoji       = $request->emoji;
        $user->gender    = $request->gender;
        $user->image1    = $final_name1;
        $user->image2    = $final_name2;
        $user->image3    = $final_name3;
        $user->image4    = $final_name4;
        $user->image5    = $final_name5;
        $user->image6    = $final_name6;
        $user->about     = $request->about;
        $user->industry  = $request->industry;
        $user->job_title = $request->job_title;
        $user->company   = $request->company;
        $user->living    = $request->living;

        $user->save();

        return $user;
    }

    public function finduser($id) {
        $user = User::find($id);

        return response()->json(['status' => true, 'details' => $user]);

    }

    public function Getuser($id) {
        $user = User::find($id);

        if ($user) {

            if ($user->gender == 'Male') {
                $friend = User::where('gender', 'Female')->paginate(5);

                return response()->json(['status' => true, 'message' => $friend, 'user_data' => $user]);
            } else {
                $friend = User::where('gender', 'Male')->paginate(5);

                return response()->json(['status' => true, 'message' => $friend, 'user_data' => $user]);
            }

        } else {
            return response()->json(['status' => false, 'message' => 'No friend found!!']);

        }

    }

}
