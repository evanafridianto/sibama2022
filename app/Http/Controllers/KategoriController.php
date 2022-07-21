<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index()
    {
        $title = 'Data Kategori';
        if (request()->ajax()) {
            $kategori = Kategori::latest();
            return DataTables::of($kategori)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '  <a href="' . route('kategori.edit', $row->id) . '" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" onclick="destroy(' . $row->id .  ')" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.kategori.index', compact('title'));
    }

    public function create()
    {
        $title = 'Tambah Data';
        return view('pages.kategori.form', compact(['title']));
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);
        $title = 'Edit Data';
        return view('pages.kategori.form', compact(['title', 'kategori']));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' =>  'required',
            'induk' =>  'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false]);
        } else {
            if (empty($request->id)) { //CREATE
                $kategori = new Kategori();
                $kategori->nama = $request->nama;
                $kategori->induk = $request->induk;

                DB::beginTransaction();
                try {
                    $kategori->save();
                    DB::commit();
                    return response()->json(['status' => true, 'redirect' =>  route("kategori.create")]);
                } catch (\Exception $e) {
                    DB::rollBack();
                    // return response()->json(['status' => false, 'err' => $e->getMessage()]);
                }
            } else { //UPDATE
                $kategori =  Kategori::find($request->id);
                $kategori->nama = $request->nama;
                $kategori->induk = $request->induk;
                try {
                    $kategori->save();
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
        $kecamatan = Kategori::findOrFail($id);
        $kecamatan->delete();
        return response()->json(['status' => true]);
    }
}