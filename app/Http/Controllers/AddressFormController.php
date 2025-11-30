<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressFormController extends Controller
{
    public function getStates(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->country_id;

            $states = DB::table('states')
                ->where('country_id', $data)
                ->orderBy('name', 'ASC')
                ->get(['id', 'name']);

            return response()->json($states);
        } else {
            return back();
        }
    }

    public function getCities(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->state_id;

            $cities = DB::table('cities')
                ->where('state_id', $data)
                ->orderBy('name', 'ASC')
                ->get(['id', 'name']);

            return response()->json($cities);
        } else {
            return back();
        }
    }
}
