<?php

namespace App\Http\Controllers;

use App\Models\Jalan;
use App\Models\Kategori;
use App\Models\Drainase2020;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\Drainase2020Export;
use App\Imports\Drainase2020Import;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class Drainase2020Controller extends Controller
{
    public function index()
    {
        $title = ' Drainase 2020';
        if (request()->ajax()) {
            $drainase = Drainase2020::latest();
            return DataTables::of($drainase)
                ->addIndexColumn()
                ->editColumn('lokasi', function ($row) {
                    return $row->jalan->nama . ', ' . $row->jalan->kelurahan->nama . ', ' . $row->jalan->kecamatan->nama;
                })
                ->editColumn('kondisi_fisik', function ($row) {
                    return $row->kategori->nama;
                })
                ->addColumn('action', function ($row) {
                    $btn = '  <a href="' . route('drainase2020.edit', $row->id) . '" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                            <a href="javascript:void(0);" onclick="destroy(' . $row->id . ')" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>';
                    return $btn;
                })
                ->rawColumns(['lokasi', 'kondisi_fisik', 'action'])
                ->make(true);
        }
        return view('pages.drainase2020.index', compact(['title']));
    }

    public function create()
    {
        $title = 'Tambah Data';
        $jalan = Jalan::all();
        $fisik = Kategori::where('induk', 'Kondisi Fisik')->get();
        $sedimen = Kategori::where('induk', 'Kondisi Sedimen')->get();
        $penanganan = Kategori::where('induk', 'Penanganan')->get();
        return view('pages.drainase2020.form', compact(['title', 'jalan', 'fisik', 'sedimen', 'penanganan']));
    }
    public function edit($id)
    {
        $title = 'Edit Data';
        $jalan = Jalan::all();
        $fisik = Kategori::where('induk', 'Kondisi Fisik')->get();
        $sedimen = Kategori::where('induk', 'Kondisi Sedimen')->get();
        $penanganan = Kategori::where('induk', 'Penanganan')->get();
        $drainase = Drainase2020::find($id);
        return view('pages.drainase2020.form', compact(['title', 'jalan', 'fisik', 'sedimen', 'penanganan', 'drainase']));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jalan' =>  'required',
            'jalur_jalan' =>  'required',
            'lat_awal' => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'long_awal' => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'lat_akhir' => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'long_akhir' => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'sta' => 'required',
            'slope' => 'required',
            'panjang' => 'required|numeric|between:0,9999.9999',
            'tinggi' =>  'required|numeric|between:0,9999.9999',
            'lebar' =>  'required|numeric|between:0,9999.9999',
            'luas_penampung' =>  'required|numeric|between:0,9999.9999',
            'keliling_penampung' =>  'required|numeric|between:0,9999.9999',
            'arah_air' =>  'required',
            'tipe' =>  'required',
            'kondisi_fisik' =>  'required',
            'kondisi_sedimen' =>  'required',
            'penanganan' =>  'required',
            'tanggal' =>  'required',
            'nama_file_foto' =>  'required',
            'nama_file_dimensi' =>  'required',
            'dimensi' => 'image|mimes:jpeg,jpg,png|max:5120|nullable',
            'foto' => 'image|mimes:jpeg,jpg,png|max:5120|nullable',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false]);
        } else {
            if (empty($request->id)) { //CREATE
                $drainase2020 = new Drainase2020();
                $drainase2020->jalan_id = $request->jalan;
                $drainase2020->jalur_jalan = $request->jalur_jalan;
                $drainase2020->lat_awal = $request->lat_awal;
                $drainase2020->long_awal = $request->long_awal;
                $drainase2020->lat_akhir = $request->lat_akhir;
                $drainase2020->long_akhir = $request->long_akhir;
                $drainase2020->sta = $request->sta;
                $drainase2020->panjang = $request->panjang;
                $drainase2020->tinggi = $request->tinggi;
                $drainase2020->lebar = $request->lebar;
                $drainase2020->slope = $request->slope;
                $drainase2020->catchment_area = $request->catchment_area;
                $drainase2020->luas_penampung = $request->luas_penampung;
                $drainase2020->keliling_penampung = $request->keliling_penampung;
                $drainase2020->tipe = $request->tipe;
                $drainase2020->arah_air = $request->arah_air;
                $drainase2020->kondisi_fisik_id = $request->kondisi_fisik;
                $drainase2020->kondisi_sedimen_id = $request->kondisi_sedimen;
                $drainase2020->penanganan_id = $request->penanganan;
                // $drainase2020->file_dimensi = $request->file_dimensi;
                $drainase2020->nama_file_dimensi = $request->nama_file_dimensi;
                // $drainase2020->file_foto = $request->file_foto;
                $drainase2020->nama_file_foto = $request->nama_file_foto;
                $drainase2020->date = $request->tanggal;

                DB::beginTransaction();
                try {
                    if ($request->hasFile('foto')) {
                        $fotoName =  time() . rand() . '.' . $request->file('foto')->getClientOriginalExtension();
                        $drainase2020->file_foto = $fotoName;
                        $request->file('foto')->storeAs('2020/foto', $fotoName, 'public');
                    }
                    if ($request->hasFile('dimensi')) {
                        $dimensiName =  time() . rand() . '.' . $request->file('dimensi')->getClientOriginalExtension();
                        $drainase2020->file_dimensi = $dimensiName;
                        $request->file('dimensi')->storeAs('2020/dimensi', $dimensiName, 'public');
                    }

                    $drainase2020->save();
                    DB::commit();
                    return response()->json(['status' => true, 'redirect' =>  route("drainase2020.create")]);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return response()->json(['status' => false, 'err' => $e->getMessage()]);
                }
            } else { //UPDATE
                $drainase2020 =  Drainase2020::find($request->id);
                $drainase2020->jalan_id = $request->jalan;
                $drainase2020->jalur_jalan = $request->jalur_jalan;
                $drainase2020->lat_awal = $request->lat_awal;
                $drainase2020->long_awal = $request->long_awal;
                $drainase2020->lat_akhir = $request->lat_akhir;
                $drainase2020->long_akhir = $request->long_akhir;
                $drainase2020->sta = $request->sta;
                $drainase2020->panjang = $request->panjang;
                $drainase2020->tinggi = $request->tinggi;
                $drainase2020->lebar = $request->lebar;
                $drainase2020->slope = $request->slope;
                $drainase2020->catchment_area = $request->catchment_area;
                $drainase2020->luas_penampung = $request->luas_penampung;
                $drainase2020->keliling_penampung = $request->keliling_penampung;
                $drainase2020->tipe = $request->tipe;
                $drainase2020->arah_air = $request->arah_air;
                $drainase2020->kondisi_fisik_id = $request->kondisi_fisik;
                $drainase2020->kondisi_sedimen_id = $request->kondisi_sedimen;
                $drainase2020->penanganan_id = $request->penanganan;
                // $drainase2020->file_dimensi = $request->file_dimensi;
                $drainase2020->nama_file_dimensi = $request->nama_file_dimensi;
                // $drainase2020->file_foto = $request->file_foto;
                $drainase2020->nama_file_foto = $request->nama_file_foto;
                $drainase2020->date = $request->tanggal;

                try {
                    if ($request->hasFile('foto')) {
                        if ($drainase2020->file_foto != '' && Storage::exists('public/2020/foto/' . $drainase2020->foto)) {
                            Storage::delete('public/2020/foto/' . $drainase2020->foto);
                        }
                        $fotoName =  time() . rand() . '.' . $request->file('foto')->getClientOriginalExtension();
                        $drainase2020->file_foto = $fotoName;
                        $request->file('foto')->storeAs('2020/foto', $fotoName, 'public');
                    }

                    if ($request->hasFile('dimensi')) {
                        if ($drainase2020->file_dimensi != '' && Storage::exists('public/2020/dimensi/' . $drainase2020->dimensi)) {
                            Storage::delete('public/2020/dimensi/' . $drainase2020->dimensi);
                        }
                        $dimensiName =  time() . rand() . '.' . $request->file('dimensi')->getClientOriginalExtension();
                        $drainase2020->file_dimensi = $dimensiName;
                        $request->file('dimensi')->storeAs('2020/dimensi', $dimensiName, 'public');
                    }

                    $drainase2020->save();
                    DB::commit();
                    return response()->json(['status' => true, 'redirect' =>  route("drainase2020.edit", $request->id)]);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return response()->json(['status' => false, 'err' => $e->getMessage()]);
                }
            };
        }
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
                Excel::import(new Drainase2020Import, request()->file('file_xlsx'));
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
        return Excel::download(new Drainase2020Export, 'Drainase2020.xlsx');
    }

    public function destroy($id)
    {
        $drainase2020 = Drainase2020::findOrFail($id);
        if ($drainase2020->file_foto != '' && Storage::exists('public/2020/foto/' . $drainase2020->file_foto)) {
            Storage::delete('public/2020/foto/' . $drainase2020->file_foto);
        }
        if ($drainase2020->file_dimensi != '' && Storage::exists('public/2020/dimensi/' . $drainase2020->file_dimensi)) {
            Storage::delete('public/2020/dimensi/' . $drainase2020->file_dimensi);
        }
        $drainase2020->delete();
        return response()->json(['status' => true]);
    }
}