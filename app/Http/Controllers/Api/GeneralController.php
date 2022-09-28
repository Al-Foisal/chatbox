<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller {
    public function help() {
        $help = DB::table('helps')->get();

        return $help;
    }
}
