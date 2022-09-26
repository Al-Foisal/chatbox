<?php

namespace App\Http\Controllers;

use App\Models\RegistrationMarriage;
use Illuminate\Http\Request;

class RegistrationMarriageController extends Controller {
    public function addRegistration(Request $request) {

        $add_data = new RegistrationMarriage();

        if ($request->file('profile_pic') != '\0') {

            if ($request->file('profile_pic') != '\0') {

                if ($image = $request->file('profile_pic')) {
                    $imagename = time() . '.' . $image->getClientOriginalName();
                    $directory = 'image/';
                    $image->move($directory, $imagename);
                    $imageurl = $directory . $imagename;
                } else {
                    $imageurl = '';
                }

            }

        }

        if ($imageurl) {
            $add_data->profile_pic = $imageurl;
            $add_data->save();
        }

        if ($request->file('nid_card') != '\0') {

            if ($request->file('nid_card') != '\0') {

                if ($image = $request->file('nid_card')) {
                    $imagename = time() . '.' . $image->getClientOriginalName();
                    $directory = 'image/';
                    $image->move($directory, $imagename);
                    $imageurl1 = $directory . $imagename;
                } else {
                    $imageurl1 = '';
                }

            }

        }

        if ($imageurl1) {
            $add_data->nid_card = $imageurl1;
            $add_data->save();
        }

        if ($request->file('image1') != '\0') {

            if ($request->file('image1') != '\0') {

                if ($image = $request->file('image1')) {
                    $imagename = time() . '.' . $image->getClientOriginalName();
                    $directory = 'image/';
                    $image->move($directory, $imagename);
                    $imageurl2 = $directory . $imagename;
                } else {
                    $imageurl2 = '';
                }

            }

        }

        if ($imageurl2) {
            $add_data->image1 = $imageurl2;
            $add_data->save();
        }

        if ($request->file('image2') != '\0') {

            if ($request->file('image2') != '\0') {

                if ($image = $request->file('image2')) {
                    $imagename = time() . '.' . $image->getClientOriginalName();
                    $directory = 'image/';
                    $image->move($directory, $imagename);
                    $imageurl3 = $directory . $imagename;
                } else {
                    $imageurl3 = '';
                }

            }

        }

        if ($imageurl3) {
            $add_data->image2 = $imageurl3;
            $add_data->save();
        }

        if ($request->file('image3') != '\0') {

            if ($request->file('image3') != '\0') {

                if ($image = $request->file('image3')) {
                    $imagename = time() . '.' . $image->getClientOriginalName();
                    $directory = 'image/';
                    $image->move($directory, $imagename);
                    $imageurl4 = $directory . $imagename;
                } else {
                    $imageurl4 = '';
                }

            }

        }

        if ($imageurl4) {
            $add_data->image3 = $imageurl4;
            $add_data->save();
        }

        if ($request->file('image4') != '\0') {

            if ($request->file('image4') != '\0') {

                if ($image = $request->file('image4')) {
                    $imagename = time() . '.' . $image->getClientOriginalName();
                    $directory = 'image/';
                    $image->move($directory, $imagename);
                    $imageurl5 = $directory . $imagename;
                } else {
                    $imageurl5 = '';
                }

            }

        }

        if ($imageurl5) {
            $add_data->image4 = $imageurl5;
            $add_data->save();
        }

        $add_data->name   = $request->name;
        $add_data->number = $request->number;

        $add_data->permanent_address  = $request->permanent_address;
        $add_data->educational_status = $request->educational_status;
        $add_data->family_member      = $request->family_member;
        $add_data->home_districts     = $request->home_districts;
        $add_data->monthly_income     = $request->monthly_income;
        $add_data->height             = $request->height;
        $add_data->color              = $request->color;
        $add_data->about_me           = $request->about_me;
        $add_data->present_address    = $request->present_address;
        $add_data->work_type          = $request->work_type;
        $add_data->password           = bcrypt($request->password);

        $add_data->interested = $request->interested;
        $add_data->save();

        return response()->json(['status' => true, 'message' => 'User Marriage Registration added!!']);

    }

    public function addRegistrationUpdate(Request $request) {

        $add_data = RegistrationMarriage::find($request->id);

        if ($request->file('profile_pic') != '\0') {

            if ($request->file('profile_pic') != '\0') {

                if ($image = $request->file('profile_pic')) {

                    if (file_Exists($add_data->profile_pic)) {
                        unlink(($add_data->profile_pic));
                    }

                    $imagename = time() . '.' . $image->getClientOriginalName();
                    $directory = 'image/';
                    $image->move($directory, $imagename);
                    $imageurl = $directory . $imagename;
                } else {
                    $imageurl = $add_data->profile_pic;
                }

            }

        }

        if ($imageurl) {
            $add_data->profile_pic = $imageurl;
            $add_data->save();
        }

        if ($request->file('nid_card') != '\0') {

            if ($request->file('nid_card') != '\0') {

                if ($image = $request->file('nid_card')) {

                    if (file_Exists($add_data->nid_card)) {
                        unlink(($add_data->nid_card));
                    }

                    $imagename = time() . '.' . $image->getClientOriginalName();
                    $directory = 'image/';
                    $image->move($directory, $imagename);
                    $imageurl1 = $directory . $imagename;
                } else {
                    $imageurl1 = $add_data->nid_card;
                }

            }

        }

        if ($imageurl1) {
            $add_data->nid_card = $imageurl1;
            $add_data->save();
        }

        if ($request->file('image1') != '\0') {

            if ($request->file('image1') != '\0') {

                if ($image = $request->file('image1')) {

                    if (file_Exists($add_data->image1)) {
                        unlink(($add_data->image1));
                    }

                    $imagename = time() . '.' . $image->getClientOriginalName();
                    $directory = 'image/';
                    $image->move($directory, $imagename);
                    $imageurl2 = $directory . $imagename;
                } else {
                    $imageurl2 = $add_data->image1;
                }

            }

        }

        if ($imageurl2) {
            $add_data->image1 = $imageurl2;
            $add_data->save();
        }

        if ($request->file('image2') != '\0') {

            if ($request->file('image2') != '\0') {

                if ($image = $request->file('image2')) {

                    if (file_Exists($add_data->image2)) {
                        unlink(($add_data->image2));
                    }

                    $imagename = time() . '.' . $image->getClientOriginalName();
                    $directory = 'image/';
                    $image->move($directory, $imagename);
                    $imageurl3 = $directory . $imagename;
                } else {
                    $imageurl3 = $add_data->image2;
                }

            }

        }

        if ($imageurl3) {
            $add_data->image2 = $imageurl3;
            $add_data->save();
        }

        if ($request->file('image3') != '\0') {

            if ($request->file('image3') != '\0') {

                if ($image = $request->file('image3')) {

                    if (file_Exists($add_data->image3)) {
                        unlink(($add_data->image3));
                    }

                    $imagename = time() . '.' . $image->getClientOriginalName();
                    $directory = 'image/';
                    $image->move($directory, $imagename);
                    $imageurl4 = $directory . $imagename;
                } else {
                    $imageurl4 = $add_data->image3;
                }

            }

        }

        if ($imageurl4) {
            $add_data->image3 = $imageurl4;
            $add_data->save();
        }

        if ($request->file('image4') != '\0') {

            if ($request->file('image4') != '\0') {

                if ($image = $request->file('image4')) {

                    if (file_Exists($add_data->image4)) {
                        unlink(($add_data->image4));
                    }

                    $imagename = time() . '.' . $image->getClientOriginalName();
                    $directory = 'image/';
                    $image->move($directory, $imagename);
                    $imageurl5 = $directory . $imagename;
                } else {
                    $imageurl5 = $add_data->image4;
                }

            }

        }

        if ($imageurl5) {
            $add_data->image4 = $imageurl5;
            $add_data->save();
        }

        $add_data->name   = $request->name;
        $add_data->number = $request->number;

        $add_data->permanent_address  = $request->permanent_address;
        $add_data->educational_status = $request->educational_status;
        $add_data->family_member      = $request->family_member;
        $add_data->home_districts     = $request->home_districts;
        $add_data->monthly_income     = $request->monthly_income;
        $add_data->height             = $request->height;
        $add_data->color              = $request->color;
        $add_data->about_me           = $request->about_me;
        $add_data->present_address    = $request->present_address;
        $add_data->work_type          = $request->work_type;

        $add_data->interested = $request->interested;
        $add_data->save();

        return response()->json(['status' => true, 'message' => 'User Marriage Registration Updated!!']);

    }

    public function GetUsers() {
        $get_data = RegistrationMarriage::get();

        return response()->json($get_data);
    }

    public function GetUser($id) {
        $get_data = RegistrationMarriage::find($id);

        return response()->json($get_data);

    }

    public function login(Request $request) {

        $member = RegistrationMarriage::where('number', $request->number)->first();

        if ($member) {

            if (password_verify($request->password, $member->password)) {

                return response()->json(['status' => true, 'customer_id' => $member->id]);
            } else {
                return response()->json(['status' => false, 'message' => 'Your password is incorrect!!']);
            }

        } else {
            return response()->json(['status' => false, 'message' => 'No account found in your Number']);
        }

    }

}
