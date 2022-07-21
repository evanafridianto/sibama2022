<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use Illuminate\Http\Request;

class KelurahanController extends Controller
{
    //



    public function kelByKec($idKec)
    {
        if (request()->ajax()) {
            $kelurahan = Kelurahan::where('kecamatan_id', $idKec)->get();
            return response()->json($kelurahan);
        }
    }
}