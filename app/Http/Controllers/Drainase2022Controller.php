<?php

namespace App\Http\Controllers;

use App\Models\Jalan;
use App\Models\Kategori;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Rules\MimeTypeKml;
use App\Models\Drainase2022;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\Drainase2022Export;
use App\Imports\Drainase2022Import;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

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
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();
        $jalan = Jalan::all();
        $fisik = Kategori::where('induk', 'Kondisi Fisik')->get();
        return view('pages.drainase2022.form', compact(['title', 'kecamatan', 'kelurahan', 'jalan', 'fisik']));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_saluran' =>  'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'nama_jalan' => 'required',
            'sisi' => 'required',
            'panjang' => 'required|numeric|between:0,9999.9999',
            'tinggi' =>  'required|numeric|between:0,9999.9999',
            'lebar_atas' =>  'required|numeric|between:0,9999.9999',
            'lebar_bawah' =>  'required|numeric|between:0,9999.9999',
            'arah' =>  'required',
            'tipe' =>  'required',
            'kondisi_fisik' =>  'required',
            'foto' => 'image|mimes:jpeg,jpg,png|max:5120|nullable',
            'file_kmz' =>  ['required', 'max:5000', function ($attribute, $value, $fail) use ($request) {
                if ($request->file('file_kmz')->getClientOriginalExtension() != 'kmz') {
                    $fail('The file kmz must be a file of type: kmz.');
                }
            },],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false]);
        } else {
            if (empty($request->id)) { //CREATE
                $drainase2020 = new Drainase2022();
                $drainase2020->kode_saluran = $request->kode_saluran;
                $drainase2020->kecamatan = $request->kecamatan;
                $drainase2020->kelurahan = $request->kelurahan;
                $drainase2020->nama_jalan = $request->nama_jalan;
                $drainase2020->sisi = $request->sisi;
                $drainase2020->panjang = $request->panjang;
                $drainase2020->tinggi = $request->tinggi;
                $drainase2020->lebar_atas = $request->lebar_atas;
                $drainase2020->lebar_bawah = $request->lebar_bawah;
                $drainase2020->arah = $request->arah;
                $drainase2020->tipe = $request->tipe;
                $drainase2020->kondisi_fisik = $request->kondisi_fisik;
                $drainase2020->foto = $request->foto;

                DB::beginTransaction();
                try {
                    if ($request->hasFile('file_kmz')) {
                        $name = strtolower(str_replace(' ', '', $request->kelurahan)) . '/' . $request->kode_saluran . '.' . $request->file('file_kmz')->getClientOriginalExtension();
                        $drainase2020->file_kmz = $name;
                        $request->file('file_kmz')->storeAs('kmz', $name, 'public');
                    }
                    $drainase2020->save();
                    DB::commit();
                    return response()->json(['status' => true, 'redirect' =>  route("drainase2022.create")]);
                } catch (\Exception $e) {
                    DB::rollBack();
                    // return response()->json(['status' => false, 'err' => $e->getMessage()]);
                }
            } else { //UPDATE
                $drainase2020 =  Drainase2022::find($request->id);
                $drainase2020->kode_saluran = $request->kode_saluran;
                $drainase2020->kecamatan = $request->kecamatan;
                $drainase2020->kelurahan = $request->kelurahan;
                $drainase2020->nama_jalan = $request->nama_jalan;
                $drainase2020->sisi = $request->sisi;
                $drainase2020->panjang = $request->panjang;
                $drainase2020->tinggi = $request->tinggi;
                $drainase2020->lebar_atas = $request->lebar_atas;
                $drainase2020->lebar_bawah = $request->lebar_bawah;
                $drainase2020->arah = $request->arah;
                $drainase2020->tipe = $request->tipe;
                $drainase2020->kondisi_fisik = $request->kondisi_fisik;
                $drainase2020->foto = $request->foto;
                $drainase2020->file_kmz = $request->file_kmz;
                try {
                    $drainase2020->save();
                    DB::commit();
                    return response()->json(['status' => true, 'redirect' =>  route("drainase2020.edit", $request->id)]);
                } catch (\Throwable $th) {
                    DB::rollBack();
                }
            }
        };
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
                Excel::import(new Drainase2022Import, request()->file('file_xlsx'));
                DB::commit();
                return response()->json(['status' => true]);
            } catch (\Exception $e) {
                DB::rollBack();
                // return response()->json(['status' => false, 'err' => $e->getMessage()]);
            }
        };
    }

    public function export()
    {
        return Excel::download(new Drainase2022Export, 'Drainase2022.xlsx');
    }

    public function destroy($id)
    {
        $drainase2022 = Drainase2022::findOrFail($id);
        if (Storage::exists('public/kmz/' . $drainase2022->file_kmz)) {
            Storage::delete('public/kmz/' . $drainase2022->file_kmz);
        }
        $drainase2022->delete();
        return response()->json(['status' => true]);
    }
}