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
                           <li class="breadcrumb-item"><a href="{{ route('drainase2022.index') }}">Data Drainase 2022</a>
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
                                   <form id="drainase2022-form">
                                       <div class="form-row">
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Kecamatan</label>
                                                   <input type="hidden" name="id" value="" class="form-control">
                                                   <select class="form-control" name="kecamatan">
                                                       <option value="">Pilih Kecamatan</option>
                                                       @foreach ($kecamatan as $item)
                                                           <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                                       @endforeach
                                                   </select>
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Kelurahan</label>
                                                   <select class="form-control" name="kelurahan">
                                                       <option value="">Pilih Kelurahan</option>
                                                       @foreach ($kelurahan as $item)
                                                           <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                                       @endforeach
                                                   </select>
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="form-row">
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Nama Jalan</label>
                                                   <select class="form-control" name="nama_jalan">
                                                       <option value="">Pilih Jalan</option>
                                                       @foreach ($jalan as $item)
                                                           <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                                       @endforeach
                                                   </select>
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Kode Saluran</label>
                                                   <input type="text" class="form-control" name="kode_saluran"
                                                       placeholder="Kode Saluran">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="form-row">
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Panjang</label>
                                                   <input type="text" class="form-control" name="panjang"
                                                       placeholder="Panjang">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Tinggi</label>
                                                   <input type="text" class="form-control" name="tinggi"
                                                       placeholder="Tinggi">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="form-row">
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Lebar Atas</label>
                                                   <input type="text" class="form-control" name="lebar_atas"
                                                       placeholder="Lebar Atas">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Lebar Bawah</label>
                                                   <input type="text" class="form-control" name="lebar_bawah"
                                                       placeholder="Lebar Bawah">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="form-row">
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Arah Aliran</label>
                                                   <select class="form-control" name="arah">
                                                       <option value="">Pilih Arah Aliran</option>
                                                       <option value="Timur">Timur</option>
                                                       <option value="Barat">Barat</option>
                                                       <option value="Selatan">Selatan</option>
                                                       <option value="Utara">Utara</option>
                                                   </select>
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Tipe</label>
                                                   <select class="form-control" name="tipe">
                                                       <option value="">Pilih Tipe</option>
                                                       <option value="Terbuka">Terbuka</option>
                                                       <option value="Tertutup">Tertutup</option>
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
                                                           <option value="{{ $item->nama }}">{{ $item->nama }}
                                                           </option>
                                                       @endforeach
                                                   </select>
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Sisi Jalan</label>
                                                   <select class="form-control" name="sisi">
                                                       <option value="">Pilih Sisi Jalan</option>
                                                       <option value="Kanan">Kanan</option>
                                                       <option value="Kiri">Kiri</option>
                                                   </select>
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="form-row">
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>File KMZ</label>
                                                   <input type="file" name="file_kmz" class="form-control"
                                                       accept=".kmz" />
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Foto</label>
                                                   <input type="file" name="foto" class="form-control"
                                                       accept="image/*" />
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="btn-list">
                                           <button type="submit" class="btn btn-primary">Submit</button>
                                           <a href="{{ route('drainase2022.index') }}" class="btn btn-dark">Kembali</a>
                                       </div>
                                   </form>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <script src="{{ asset('apps/drainase2022/form.js') }}"></script>
   @endsection
