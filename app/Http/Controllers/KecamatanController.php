<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class KecamatanController extends Controller
{
    public function index()
    {
        $title = 'Data Kecamatan';
        if (request()->ajax()) {
            $kecamatan = Kecamatan::latest();
            return DataTables::of($kecamatan)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '  <a href="' . route('kecamatan.edit', $row->id) . '" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" onclick="destroy(' . $row->id .  ')" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.kecamatan.index', compact('title'));
    }

    public function create()
    {
        $title = 'Tambah Data';
        return view('pages.kecamatan.form', compact(['title']));
    }

    public function edit($id)
    {
        $kecamatan = Kecamatan::find($id);
        $title = 'Edit Data';
        return view('pages.kecamatan.form', compact(['title', 'kecamatan']));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' =>  'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false]);
        } else {
            if (empty($request->id)) { //CREATE
                $kecamatan = new Kecamatan();
                $kecamatan->nama = $request->nama;

                DB::beginTransaction();
                try {
                    $kecamatan->save();
                    DB::commit();
                    return response()->json(['status' => true, 'redirect' =>  route("kecamatan.create")]);
                } catch (\Exception $e) {
                    DB::rollBack();
                    // return response()->json(['status' => false, 'err' => $e->getMessage()]);
                }
            } else { //UPDATE
                $kecamatan =  Kecamatan::find($request->id);
                $kecamatan->nama = $request->nama;
                try {
                    $kecamatan->save();
                    DB::commit();
                    return response()->json(['status' => true, 'redirect' =>  route("kecamatan.edit", $request->id)]);
                } catch (\Throwable $th) {
                    DB::rollBack();
                }
            }
        };
    }

    public function destroy($id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        $kecamatan->delete();
        return response()->json(['status' => true]);
    }
}