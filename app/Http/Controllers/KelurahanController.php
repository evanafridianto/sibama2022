<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use App\Exports\KelurahanExport;
use App\Imports\KelurahanImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class KelurahanController extends Controller
{
    public function index()
    {
        $title = 'Data Kelurahan';
        if (request()->ajax()) {
            $kelurahan = Kelurahan::latest();
            return DataTables::of($kelurahan)
                ->addIndexColumn()
                ->editColumn('kecamatan', function ($row) {
                    return $row->kecamatan->nama;
                })
                ->addColumn('action', function ($row) {

                    $btn = '  <a href="' . route('kelurahan.edit', $row->id) . '" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" onclick="destroy(' . $row->id .  ')" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>';
                    return $btn;
                })
                ->rawColumns(['kecamatan', 'action'])
                ->make(true);
        }
        return view('pages.kelurahan.index', compact('title'));
    }

    public function kelByKec($idKec)
    {
        if (request()->ajax()) {
            $kelurahan = Kelurahan::where('kecamatan_id', $idKec)->get();
            return response()->json($kelurahan);
        }
    }

    public function create()
    {
        $kecamatan = Kecamatan::all();
        $title = 'Tambah Data';
        return view('pages.kelurahan.form', compact(['title', 'kecamatan']));
    }

    public function edit($id)
    {
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::find($id);
        $title = 'Edit Data';
        return view('pages.kelurahan.form', compact(['title', 'kelurahan', 'kecamatan']));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' =>  'required',
            'kecamatan' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false]);
        } else {
            if (empty($request->id)) { //CREATE
                $kelurahan = new Kelurahan();
                $kelurahan->nama = $request->nama;
                $kelurahan->kecamatan_id = $request->kecamatan;

                DB::beginTransaction();
                try {
                    $kelurahan->save();
                    DB::commit();
                    return response()->json(['status' => true, 'redirect' =>  route("kelurahan.create")]);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return response()->json(['status' => false, 'err' => $e->getMessage()]);
                }
            } else { //UPDATE
                $kelurahan =  Kelurahan::find($request->id);
                $kelurahan->nama = $request->nama;
                $kelurahan->kecamatan_id = $request->kecamatan;
                try {
                    $kelurahan->save();
                    DB::commit();
                    return response()->json(['status' => true, 'redirect' =>  route("kelurahan.edit", $request->id)]);
                } catch (\Throwable $th) {
                    DB::rollBack();
                }
            }
        };
    }

    public function export()
    {
        return Excel::download(new KelurahanExport, 'Kelurahan.xlsx');
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
                Excel::import(new KelurahanImport, request()->file('file_xlsx'));
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
        $kelurahan = Kelurahan::findOrFail($id);
        $kelurahan->delete();
        return response()->json(['status' => true]);
    }
}