<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller {
    public function help() {
        $help = DB::table('helps')->get();

        return $help;
    }

    public function packages() {
        // DB::table("users")
        //             ->select("users.id"
        //                 ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
        //                 * cos(radians(users.lat)) 
        //                 * cos(radians(users.long) - radians(" . $lon . ")) 
        //                 + sin(radians(" .$lat. ")) 
        //                 * sin(radians(users.lat))) AS distance"))
        //                 ->groupBy("users.id")
        //                 ->get();
        $package = Package::all();

        return $package;
    }

    public function packageDetails($id) {
        $package = Package::where('id', $id)
            ->with('packageDetails', 'packagePricing')
            ->first();

        return $package;
    }
}
