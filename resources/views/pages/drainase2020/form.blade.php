   @extends('layouts.main')
   @section('content')
       <div class="content-body">
           <!-- row -->
           <div class="container-fluid">
               <div class="row page-titles mx-0">
                   <div class="col-sm-6 p-md-0">
                       <div class="welcome-text">
                           <h4>{{ $title }}</h4>
                       </div>
                   </div>
                   <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                       <ol class="breadcrumb">
                           <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                           <li class="breadcrumb-item"><a href="{{ route('drainase2020.index') }}">Data Drainase
                                   2020</a>
                           </li>
                           <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $title }}</a></li>
                       </ol>
                   </div>
               </div>
               <div class="row">
                   <div class="col-12">
                       <div class="card">
                           <div class="card-body">
                               <div class="basic-form">
                                   <form id="drainase-form">
                                       <div class="form-row">
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Nama Jalan</label>
                                                   <input type="hidden" name="id"
                                                       value="{{ Route::is('drainase2020.edit') ? $drainase->id : '' }}"
                                                       class="form-control">
                                                   <select class="form-control" name="jalan">
                                                       <option value="">Pilih Jalan</option>
                                                       @foreach ($jalan as $item)
                                                           <option
                                                               {{ Route::is('drainase2020.edit') && $drainase->jalan_id == $item->id ? 'selected' : '' }}
                                                               value="{{ $item->id }}">
                                                               {{ $item->nama . ', ' . $item->kelurahan->nama . ', ' . $item->kecamatan->nama }}
                                                           </option>
                                                       @endforeach
                                                   </select>
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Jalur Jalan</label>
                                                   <select class="form-control" name="jalur_jalan">
                                                       <option value="">Pilih Jalur Jalan</option>
                                                       <option
                                                           {{ Route::is('drainase2020.edit') && $drainase->jalur_jalan == 'Kanan' ? 'selected' : '' }}
                                                           value="Kanan">Kanan</option>
                                                       <option
                                                           {{ Route::is('drainase2020.edit') && $drainase->jalur_jalan == 'Kiri' ? 'selected' : '' }}
                                                           value="Kiri">Kiri</option>
                                                   </select>
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="form-row">
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Latitude Awal</label>
                                                   <input type="text" class="form-control" name="lat_awal"
                                                       value="{{ Route::is('drainase2020.edit') ? $drainase->lat_awal : '' }}"
                                                       placeholder="Latitude Awal">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Longitude Awal</label>
                                                   <input type="text" class="form-control" name="long_awal"
                                                       value="{{ Route::is('drainase2020.edit') ? $drainase->long_awal : '' }}"
                                                       placeholder="Longitude Awal">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="form-row">
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Latitude Akhir</label>
                                                   <input type="text" class="form-control" name="lat_akhir"
                                                       value="{{ Route::is('drainase2020.edit') ? $drainase->lat_akhir : '' }}"
                                                       placeholder="Latitude Akhir">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Longitude Akhir</label>
                                                   <input type="text" class="form-control" name="long_akhir"
                                                       value="{{ Route::is('drainase2020.edit') ? $drainase->long_akhir : '' }}"
                                                       placeholder="Longitude Akhir">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                       </div>

                                       <div class="form-row">
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>STA</label>
                                                   <input type="text" class="form-control" name="sta"
                                                       value="{{ Route::is('drainase2020.edit') ? $drainase->sta : '' }}"
                                                       placeholder="STA">
                                                   <small class="text-danger"></small>
                                               </div>

                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Slope</label>
                                                   <input type="text" class="form-control" name="slope"
                                                       value="{{ Route::is('drainase2020.edit') ? $drainase->slope : '' }}"
                                                       placeholder="Slope (m)">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="form-row">
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Panjang</label>
                                                   <input type="text" class="form-control" name="panjang"
                                                       value="{{ Route::is('drainase2020.edit') ? $drainase->panjang : '' }}"
                                                       placeholder="Panjang (m)">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Tinggi</label>
                                                   <input type="text" class="form-control" name="tinggi"
                                                       value="{{ Route::is('drainase2020.edit') ? $drainase->tinggi : '' }}"
                                                       placeholder="Tinggi (m)">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="form-row">
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Lebar</label>
                                                   <input type="text" class="form-control" name="lebar"
                                                       value="{{ Route::is('drainase2020.edit') ? $drainase->lebar : '' }}"
                                                       placeholder="Lebar (m)">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Luas Penampung</label>
                                                   <input type="text" class="form-control" name="luas_penampung"
                                                       value="{{ Route::is('drainase2020.edit') ? $drainase->luas_penampung : '' }}"
                                                       placeholder="Luas Penampung (m2)">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="form-row">
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Keliling Penampung</label>
                                                   <input type="text" class="form-control" name="keliling_penampung"
                                                       value="{{ Route::is('drainase2020.edit') ? $drainase->keliling_penampung : '' }}"
                                                       placeholder="Keliling Penampung (m)">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Catchment Area</label>
                                                   <input type="text" class="form-control" name="catchment_area"
                                                       value="{{ Route::is('drainase2020.edit') ? $drainase->catchment_area : '' }}"
                                                       placeholder="Catchment Area (ha)">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="form-row">
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Tipe</label>
                                                   <select class="form-control" name="tipe">
                                                       <option value="">Pilih Tipe</option>
                                                       <option
                                                           {{ Route::is('drainase2020.edit') && $drainase->tipe == 'Terbuka' ? 'selected' : '' }}
                                                           value="Terbuka">Terbuka</option>
                                                       <option
                                                           {{ Route::is('drainase2020.edit') && $drainase->tipe == 'Tertutup' ? 'selected' : '' }}
                                                           value="Tertutup">Tertutup</option>
                                                   </select>
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Arah Air</label>
                                                   <select class="form-control" name="arah_air">
                                                       <option value="">Pilih Arah Air</option>
                                                       <option
                                                           {{ Route::is('drainase2020.edit') && $drainase->arah_air == 'Atas' ? 'selected' : '' }}
                                                           value="Atas">Atas</option>
                                                       <option
                                                           {{ Route::is('drainase2020.edit') && $drainase->arah_air == 'Bawah' ? 'selected' : '' }}
                                                           value="Bawah">Bawah</option>

                                                   </select>
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="form-row">
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Kondisi Fisik</label>
                                                   <select class="form-control" name="kondisi_fisik">
                                                       <option value="">Pilih Kondisi Fisik</option>
                                                       @foreach ($fisik as $item)
                                                           <option
                                                               {{ Route::is('drainase2020.edit') && $drainase->kondisi_fisik_id == $item->id ? 'selected' : '' }}
                                                               value="{{ $item->id }}">{{ $item->nama }}
                                                           </option>
                                                       @endforeach
                                                   </select>
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Kondisi Sedimen</label>
                                                   <select class="form-control" name="kondisi_sedimen">
                                                       <option value="">Pilih Kondisi Sedimen</option>
                                                       @foreach ($sedimen as $item)
                                                           <option
                                                               {{ Route::is('drainase2020.edit') && $drainase->kondisi_sedimen_id == $item->id ? 'selected' : '' }}
                                                               value="{{ $item->id }}">{{ $item->nama }}
                                                           </option>
                                                       @endforeach
                                                   </select>
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="form-row">
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Penanganan</label>
                                                   <select class="form-control" name="penanganan">
                                                       <option value="">Pilih Penanganan</option>
                                                       @foreach ($penanganan as $item)
                                                           <option
                                                               {{ Route::is('drainase2020.edit') && $drainase->penanganan_id == $item->id ? 'selected' : '' }}
                                                               value="{{ $item->id }}">{{ $item->nama }}
                                                           </option>
                                                       @endforeach
                                                   </select>
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Tanggal</label>
                                                   <input type="text" class="form-control" name="tanggal"
                                                       value="{{ Route::is('drainase2020.edit') ? $drainase->date : '' }}"
                                                       placeholder="yy-mm-dd">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="form-row">
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Nama File Dimensi</label>
                                                   <input type="text" class="form-control" name="nama_file_dimensi"
                                                       value="{{ Route::is('drainase2020.edit') ? $drainase->nama_file_dimensi : '' }}"
                                                       placeholder="Nama File Dimensi">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Nama File Foto</label>
                                                   <input type="text" class="form-control" name="nama_file_foto"
                                                       value="{{ Route::is('drainase2020.edit') ? $drainase->nama_file_foto : '' }}"
                                                       placeholder="Nama File Foto">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="form-row mb-3">
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Dimensi</label>
                                                   <input type="file" name="dimensi" class="form-control"
                                                       accept="image/*" />
                                                   <small class="text-danger"></small>
                                               </div>
                                               <div id="img-preview">
                                                   @if (Route::is('drainase2020.edit') &&
                                                       !empty($drainase->file_dimensi) &&
                                                       file_exists('storage/2020/dimensi/' . $drainase->file_dimensi))
                                                       <img src="{{ asset('storage/2020/dimensi/' . $drainase->file_dimensi) }}"
                                                           alt="Picture" class="img-thumbnail preview">
                                                   @else
                                                       <img src="https://fakeimg.pl/1280x720" alt="Picture"
                                                           class="img-thumbnail preview">
                                                   @endif
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Foto</label>
                                                   <input type="file" name="foto" class="form-control"
                                                       accept="image/*" />
                                                   <small class="text-danger"></small>
                                               </div>
                                               <div id="img-preview2">
                                                   @if (Route::is('drainase2020.edit') &&
                                                       !empty($drainase->file_foto) &&
                                                       file_exists('storage/2020/foto/' . $drainase->file_foto))
                                                       <img src="{{ asset('storage/2020/foto/' . $drainase->file_foto) }}"
                                                           alt="Picture" class="img-thumbnail preview">
                                                   @else
                                                       <img src="https://fakeimg.pl/1280x720" alt="Picture"
                                                           class="img-thumbnail preview">
                                                   @endif
                                               </div>
                                           </div>
                                       </div>
                                       <div class="btn-list">
                                           <button type="submit" class="btn btn-primary">Submit</button>
                                           <a href="{{ route('drainase2020.index') }}" class="btn btn-dark">Kembali</a>
                                       </div>
                                   </form>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <script src="{{ asset('apps/drainase2020/form.js') }}"></script>
   @endsection
