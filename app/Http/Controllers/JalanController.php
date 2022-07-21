<?php

namespace App\Http\Controllers;

use App\Models\Jalan;
use App\Models\Kecamatan;
use App\Exports\JalanExport;
use App\Imports\JalanImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class JalanController extends Controller
{
    public function index()
    {
        $title = 'Data Jalan';
        if (request()->ajax()) {
            $drainase = Jalan::latest();
            return DataTables::of($drainase)
                ->addIndexColumn()
                ->editColumn('kelurahan', function ($row) {
                    return $row->kelurahan->nama;
                })
                ->editColumn('kecamatan', function ($row) {
                    return $row->kecamatan->nama;
                })
                ->addColumn('action', function ($row) {

                    $btn = '  <a href="' . route('jalan.edit', $row->id) . '" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" onclick="destroy(' . $row->id .  ')" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>';
                    return $btn;
                })
                ->rawColumns(['kelurahan', 'kecamatan', 'action'])
                ->make(true);
        }
        return view('pages.jalan.index', compact('title'));
    }


    public function create()
    {
        $kecamatan = Kecamatan::all();
        $title = 'Tambah Data';
        return view('pages.jalan.form', compact(['title', 'kecamatan']));
    }

    public function edit($id)
    {
        $jalan = Jalan::find($id);
        $kecamatan = Kecamatan::all();
        $title = 'Edit Data';
        if (request()->ajax()) {
            return response()->json($jalan);
        }
        return view('pages.jalan.form', compact(['title', 'kecamatan']));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' =>  'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false]);
        } else {
            if (empty($request->id)) { //CREATE
                $genangan = new Jalan();
                $genangan->nama = $request->nama;
                $genangan->kecamatan_id = $request->kecamatan;
                $genangan->kelurahan_id = $request->kelurahan;

                DB::beginTransaction();
                try {
                    $genangan->save();
                    DB::commit();
                    return response()->json(['status' => true, 'redirect' =>  route("jalan.create")]);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return response()->json(['status' => false, 'err' => $e->getMessage()]);
                }
            } else { //UPDATE
                $genangan =  Jalan::find($request->id);
                $genangan->nama = $request->nama;
                $genangan->kecamatan_id = $request->kecamatan;
                $genangan->kelurahan_id = $request->kelurahan;

                try {
                    $genangan->save();
                    DB::commit();
                    return response()->json(['status' => true, 'redirect' =>  route("jalan.edit", $request->id)]);
                } catch (\Throwable $th) {
                    DB::rollBack();
                }
            }
        };
    }

    public function export()
    {
        return Excel::download(new JalanExport, 'Jalan.xlsx');
    }

    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file_xlsx' => 'required|max:5000|mimes:xlsx,xls',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false]);
        } else {
            DB::beginTransaction();
            try {
                Excel::import(new JalanImport, request()->file('file_xlsx'));
                DB::commit();
                return response()->json(['status' => true]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['status' => false, 'err' => $e->getMessage()]);
            }
        };
    }

    public function destroy($id)
    {
        $jalan = Jalan::findOrFail($id);
        $jalan->delete();
        return response()->json(['status' => true]);
    }
}