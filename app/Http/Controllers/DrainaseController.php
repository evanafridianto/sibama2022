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

class DrainaseController extends Controller
{
    public function index($tahun)
    {
        $title = ' Drainase ' . $tahun;
        $tahun = $tahun;
        if ($tahun == 2022) {
            if (request()->ajax()) {
                $drainase = Drainase2022::latest();
                return DataTables::of($drainase)
                    ->addIndexColumn()
                    ->editColumn('lokasi', function ($row) {
                        return $row->nama_jalan . ', ' . $row->kelurahan . ', ' . $row->kecamatan;
                    })
                    ->addColumn('action', function ($row) {

                        $btn = '  <a href="' . route('drainase.edit', [2022, $row->id]) . '" class="btn btn-sm btn-primary"><i class="la la-pencil"></i></a>
                                                    <a href="javascript:void(0);" onclick="destroy(' . 2022 . ',' . $row->id .  ')" class="btn btn-sm btn-danger"><i class="la la-trash-o"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['lokasi', 'action'])
                    ->make(true);
            }
        }
        return view('pages.drainase.index', compact(['title', 'tahun']));
    }


    public function create($tahun)
    {
        $title = 'Tambah Data';
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();
        $jalan = Jalan::all();
        $fisik = Kategori::where('induk', 'Kondisi Fisik')->get();

        $tahun = $tahun;
        return view('pages.drainase.form', compact(['title', 'kecamatan', 'kelurahan', 'jalan', 'fisik', 'tahun']));
    }

    public function edit($tahun, $id)
    {
        if ($tahun == 2022) {
            $drainase = Drainase2022::find($id);
        }
        $title = 'Edit Data';
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();
        $jalan = Jalan::all();
        $fisik = Kategori::where('induk', 'Kondisi Fisik')->get();
        return view('pages.drainase.form', compact(['title', 'kecamatan', 'kelurahan', 'jalan', 'fisik', 'drainase']));
    }

    public function store($tahun, Request $request)
    {

        if ($tahun == 2022) {
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
                'file_kmz' =>  [$request->file_kmz_edit != '' ? '' : 'required', 'max:5000', function ($attribute, $value, $fail) use ($request) {
                    if ($request->file('file_kmz')->getClientOriginalExtension() != 'kmz') {
                        $fail('The file kmz must be a file of type: kmz.');
                    }
                },],
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors(), 'status' => false]);
            } else {
                if (empty($request->id)) { //CREATE
                    $drainase2022 = new Drainase2022();
                    $drainase2022->kode_saluran = $request->kode_saluran;
                    $drainase2022->kecamatan = $request->kecamatan;
                    $drainase2022->kelurahan = $request->kelurahan;
                    $drainase2022->nama_jalan = $request->nama_jalan;
                    $drainase2022->sisi = $request->sisi;
                    $drainase2022->panjang = $request->panjang;
                    $drainase2022->tinggi = $request->tinggi;
                    $drainase2022->lebar_atas = $request->lebar_atas;
                    $drainase2022->lebar_bawah = $request->lebar_bawah;
                    $drainase2022->arah = $request->arah;
                    $drainase2022->tipe = $request->tipe;
                    $drainase2022->kondisi_fisik = $request->kondisi_fisik;

                    DB::beginTransaction();
                    try {
                        if ($request->hasFile('file_kmz')) {
                            $kmzName = strtolower(str_replace(' ', '', $request->kelurahan)) . '/' . $request->kode_saluran . '.' . $request->file('file_kmz')->getClientOriginalExtension();
                            $drainase2022->file_kmz = $kmzName;
                            $request->file('file_kmz')->storeAs('kmz', $kmzName, 'public');
                        }

                        if ($request->hasFile('foto')) {
                            $fotoName =  time() . rand() . '.' . $request->file('foto')->getClientOriginalExtension();
                            $drainase2022->foto = $fotoName;
                            $request->file('foto')->storeAs('foto', $fotoName, 'public');
                        }

                        $drainase2022->save();
                        DB::commit();
                        return response()->json(['status' => true, 'redirect' =>  route("drainase.create", 2022)]);
                    } catch (\Exception $e) {
                        DB::rollBack();
                        // return response()->json(['status' => false, 'err' => $e->getMessage()]);
                    }
                } else { //UPDATE
                    $drainase2022 =  Drainase2022::find($request->id);
                    $drainase2022->kode_saluran = $request->kode_saluran;
                    $drainase2022->kecamatan = $request->kecamatan;
                    $drainase2022->kelurahan = $request->kelurahan;
                    $drainase2022->nama_jalan = $request->nama_jalan;
                    $drainase2022->sisi = $request->sisi;
                    $drainase2022->panjang = $request->panjang;
                    $drainase2022->tinggi = $request->tinggi;
                    $drainase2022->lebar_atas = $request->lebar_atas;
                    $drainase2022->lebar_bawah = $request->lebar_bawah;
                    $drainase2022->arah = $request->arah;
                    $drainase2022->tipe = $request->tipe;
                    $drainase2022->kondisi_fisik = $request->kondisi_fisik;
                    try {
                        if ($request->hasFile('file_kmz')) {
                            if ($drainase2022->file_kmz != '' && Storage::exists('public/kmz/' . $request->file_kmz)) {
                                Storage::delete('public/kmz/' . $request->file_kmz);
                            }
                            $kmzName = strtolower(str_replace(' ', '', $request->kelurahan)) . '/' . $request->kode_saluran . '.' . $request->file('file_kmz')->getClientOriginalExtension();
                            $drainase2022->file_kmz = $kmzName;
                            $request->file('file_kmz')->storeAs('kmz', $kmzName, 'public');
                        }
                        if ($request->hasFile('foto')) {
                            if ($drainase2022->foto != '' && Storage::exists('public/foto/' . $request->foto)) {
                                Storage::delete('public/foto/' . $request->foto);
                            }
                            $fotoName =  time() . rand() . '.' . $request->file('foto')->getClientOriginalExtension();
                            $drainase2022->foto = $fotoName;
                            $request->file('foto')->storeAs('foto', $fotoName, 'public');
                        }

                        $drainase2022->save();
                        DB::commit();
                        return response()->json(['status' => true, 'redirect' =>  route("drainase.edit", [2022, $request->id])]);
                    } catch (\Exception $e) {
                        DB::rollBack();
                        // return response()->json(['status' => false, 'err' => $e->getMessage()]);
                    }
                };
            }
        }
    }

    public function import($tahun, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file_xlsx' => 'required|max:5000|mimes:xlsx,xls',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false]);
        } else {
            DB::beginTransaction();
            try {
                if ($tahun == 2022) {
                    Excel::import(new Drainase2022Import, request()->file('file_xlsx'));
                }
                DB::commit();
                return response()->json(['status' => true]);
            } catch (\Exception $e) {
                DB::rollBack();
                // return response()->json(['status' => false, 'err' => $e->getMessage()]);
            }
        };
    }

    public function export($tahun)
    {
        if ($tahun == 2022) {
            return Excel::download(new Drainase2022Export, 'Drainase2022.xlsx');
        }
    }

    public function destroy($tahun, $id)
    {
        if ($tahun == 2022) {
            $drainase2022 = Drainase2022::findOrFail($id);
            if ($drainase2022->file_kmz != '' && Storage::exists('public/kmz/' . $drainase2022->file_kmz)) {
                Storage::delete('public/kmz/' . $drainase2022->file_kmz);
            }
            if ($drainase2022->foto != '' && Storage::exists('public/foto/' . $drainase2022->foto)) {
                Storage::delete('public/foto/' . $drainase2022->foto);
            }
            $drainase2022->delete();
        }
        return response()->json(['status' => true]);
    }
}