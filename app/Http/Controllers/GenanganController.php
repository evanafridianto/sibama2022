<?php

namespace App\Http\Controllers;

use App\Models\Genangan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\GenanganExport;
use App\Imports\GenanganImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class GenanganController extends Controller
{
    public function index()
    {
        $title = ' Titik Genangan';

        if (request()->ajax()) {
            $drainase = Genangan::latest();
            return DataTables::of($drainase)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '  <a href="' . route('genangan.edit', $row->id) . '" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" onclick="destroy(' . $row->id . ')" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.genangan.index', compact('title'));
    }

    public function edit($id)
    {
        $genangan = Genangan::find($id);
        $title = 'Edit Data';
        return view('pages.genangan.form', compact(['title', 'genangan']));
    }

    public function create()
    {
        $title = 'Tambah Data';
        return view('pages.genangan.form', compact('title'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_jalan' =>  'required',
            'alamat' => 'required',
            'latitude' => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude' => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'cctv_id' => 'required',
            'host' => 'required',
            'stream_id' =>  'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false]);
        } else {
            if (empty($request->id)) { //CREATE
                $genangan = new Genangan();
                $genangan->nama_jalan = $request->nama_jalan;
                $genangan->alamat = $request->alamat;
                $genangan->latitude = $request->latitude;
                $genangan->longitude = $request->longitude;
                $genangan->cctv_id = $request->cctv_id;
                $genangan->host = $request->host;
                $genangan->stream_id = $request->stream_id;

                DB::beginTransaction();
                try {
                    $genangan->save();
                    DB::commit();
                    return response()->json(['status' => true, 'redirect' =>  route("genangan.create")]);
                } catch (\Exception $e) {
                    DB::rollBack();
                    // return response()->json(['status' => false, 'err' => $e->getMessage()]);
                }
            } else { //UPDATE
                $genangan =  Genangan::find($request->id);
                $genangan->nama_jalan = $request->nama_jalan;
                $genangan->alamat = $request->alamat;
                $genangan->latitude = $request->latitude;
                $genangan->longitude = $request->longitude;
                $genangan->cctv_id = $request->cctv_id;
                $genangan->host = $request->host;
                $genangan->stream_id = $request->stream_id;
                try {
                    $genangan->save();
                    DB::commit();
                    return response()->json(['status' => true, 'redirect' =>  route("genangan.edit", $request->id)]);
                } catch (\Throwable $th) {
                    DB::rollBack();
                }
            }
        };
    }

    public function export()
    {
        return Excel::download(new GenanganExport, 'Titik_Genangan.xlsx');
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
                Excel::import(new GenanganImport, request()->file('file_xlsx'));
                DB::commit();
                return response()->json(['status' => true]);
            } catch (\Exception $e) {
                DB::rollBack();
                // return response()->json(['status' => false, 'err' => $e->getMessage()]);
            }
        };
    }

    public function destroy($id)
    {
        $genangan = Genangan::findOrFail($id);
        $genangan->delete();
        return response()->json(['status' => true]);
    }
}