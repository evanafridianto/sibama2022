<?php

namespace App\Http\Controllers;

use App\Models\Drainase2022;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Drainase2022Controller extends Controller
{
    public function index()
    {
        $title = ' Drainase 2022';

        if (request()->ajax()) {
            $kelahiran = Drainase2022::latest();
            return DataTables::of($kelahiran)
                ->addIndexColumn()
                ->editColumn('lokasi', function ($row) {
                    return $row->nama_jalan . ', ' . $row->kelurahan . ', ' . $row->kecamatan;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="dropdown">
                                     <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                         role="button" data-toggle="dropdown">
                                         <i class="dw dw-more"></i>
                                     </a>
                                     <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                         <a class="dropdown-item" href=""><i class="dw dw-edit2"></i> Edit</a>
                                         <a class="dropdown-item" href="javascript: void(0);" onclick="destroy(' . $row->id . ')"><i class="dw dw-delete-3"></i> Delete</a>
                                     </div>
                                 </div>';
                    return $btn;
                })
                ->rawColumns(['lokasi', 'action'])
                ->make(true);
        }
        return view('pages.drainase2022.index', compact('title'));
    }
}