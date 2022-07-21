<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class KelurahanController extends Controller
{
    public function index()
    {
        $title = 'Data Kelurahan';
        if (request()->ajax()) {
            $drainase = Kelurahan::latest();
            return DataTables::of($drainase)
                ->addIndexColumn()
                ->editColumn('kecamatan', function ($row) {
                    return $row->kecamatan->nama;
                })
                ->addColumn('action', function ($row) {

                    $btn = '  <a href="' . route('kelurahan.edit', $row->id) . '" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" onclick="destroy(' . $row->id .  ')" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>';
                    return $btn;
                })
                ->rawColumns(['kelurahan', 'kecamatan', 'action'])
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
                $genangan = new Kelurahan();
                $genangan->nama = $request->nama;
                $genangan->kecamatan_id = $request->kecamatan;

                DB::beginTransaction();
                try {
                    $genangan->save();
                    DB::commit();
                    return response()->json(['status' => true, 'redirect' =>  route("kelurahan.create")]);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return response()->json(['status' => false, 'err' => $e->getMessage()]);
                }
            } else { //UPDATE
                $genangan =  Kelurahan::find($request->id);
                $genangan->nama = $request->nama;
                $genangan->kecamatan_id = $request->kecamatan;
                try {
                    $genangan->save();
                    DB::commit();
                    return response()->json(['status' => true, 'redirect' =>  route("kelurahan.edit", $request->id)]);
                } catch (\Throwable $th) {
                    DB::rollBack();
                }
            }
        };
    }

    public function destroy($id)
    {
        $jalan = Kelurahan::findOrFail($id);
        $jalan->delete();
        return response()->json(['status' => true]);
    }
}