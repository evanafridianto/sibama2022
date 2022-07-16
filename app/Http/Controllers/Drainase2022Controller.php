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
            $drainase = Drainase2022::latest();
            return DataTables::of($drainase)
                ->addIndexColumn()
                ->editColumn('lokasi', function ($row) {
                    return $row->nama_jalan . ', ' . $row->kelurahan . ', ' . $row->kecamatan;
                })
                ->addColumn('action', function ($row) {

                    $btn = '  <a href="javascript:void(0);" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" onclick="destroy(' . $row->id . ')" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>';
                    return $btn;
                })
                ->rawColumns(['lokasi', 'action'])
                ->make(true);
        }
        return view('pages.drainase2022.index', compact('title'));
    }


    public function create()
    {
        $title = 'Tambah Data';
        return view('pages.drainase2022.form', compact('title'));
    }

    public function destroy($id)
    {
        Drainase2022::destroy($id);
        return response()->json(['status' => true]);
    }
}