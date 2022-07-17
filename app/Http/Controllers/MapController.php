<?php

namespace App\Http\Controllers;

use App\Models\Drainase2022;
use Illuminate\Http\Request;

class MapController extends Controller
{
    //
    public function index()
    {
        $title = 'Peta Drainae';
        return view('pages.map', compact('title'));
    }

    public function drainase($tahun)
    {
        if ($tahun == 2022) {
            $data = Drainase2022::all();
            return response()->json(['data' => $data]);
        }
    }
}