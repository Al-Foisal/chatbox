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
