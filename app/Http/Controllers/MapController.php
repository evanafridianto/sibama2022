<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    //
    public function index()
    {
        $title = 'Peta Drainae';
        return view('pages.map', compact('title'));
    }
}