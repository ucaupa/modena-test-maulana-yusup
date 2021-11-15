<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use Illuminate\Http\Request;

class GeolocationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('q')) {
            $query = $request->q;
            $result = Kelurahan::query()
                ->with('kecamatan.kabkot.provinsi')
                ->where('kd_pos', 'LIKE', '%' . $query . '%')
                ->get();

            return response()->json($result);
        }

        return $request->all();
    }
}
