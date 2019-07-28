<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
class DropdownAdminController extends AdminController
{
    

        public function getStateList(Request $request)
        {
            $states = DB::table("town")
            ->where("CityID",$request->city_id)
            ->pluck("TownName","TownID");
            return response()->json($states);
        }

   
}