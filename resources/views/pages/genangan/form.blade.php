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
                           <li class="breadcrumb-item"><a href="{{ route('genangan.index') }}">Titik Genangan</a>
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
                                   <form id="genangan-form">
                                       <div class="form-row">
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Nama Jalan</label>
                                                   <input type="hidden" class="form-control" name="id"
                                                       value="{{ Route::is('genangan.edit') ? $genangan->id : '' }}">
                                                   <input type="text" class="form-control" name="nama_jalan"
                                                       value="{{ Route::is('genangan.edit') ? $genangan->nama_jalan : '' }}"
                                                       placeholder="Nama Jalan">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Alamat</label>
                                                   <input type="text" class="form-control" name="alamat"
                                                       value="{{ Route::is('genangan.edit') ? $genangan->alamat : '' }}"
                                                       placeholder="Alamat">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="form-row">
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Latitude</label>
                                                   <input type="text" class="form-control" name="latitude"
                                                       value="{{ Route::is('genangan.edit') ? $genangan->latitude : '' }}"
                                                       placeholder="Latitude">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Longitude</label>
                                                   <input type="text" class="form-control" name="longitude"
                                                       value="{{ Route::is('genangan.edit') ? $genangan->longitude : '' }}"
                                                       placeholder="Longitude">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="form-row">
                                           <div class="col-md-4 col-sm-12">
                                               <div class="form-group">
                                                   <label>CCTV ID</label>
                                                   <input type="text" class="form-control" name="cctv_id"
                                                       value="{{ Route::is('genangan.edit') ? $genangan->cctv_id : '' }}"
                                                       placeholder="CCTV ID">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                           <div class="col-md-4 col-sm-12">
                                               <div class="form-group">
                                                   <label>Host</label>
                                                   <input type="text" class="form-control" name="host"
                                                       value="{{ Route::is('genangan.edit') ? $genangan->host : '' }}"
                                                       placeholder="Host">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                           <div class="col-md-4 col-sm-12">
                                               <div class="form-group">
                                                   <label>Stream ID</label>
                                                   <input type="text" class="form-control" name="stream_id"
                                                       value="{{ Route::is('genangan.edit') ? $genangan->stream_id : '' }}"
                                                       placeholder="Stream ID">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="btn-list">
                                           <button type="submit" class="btn btn-primary">Submit</button>
                                           <a href="{{ route('genangan.index') }}" class="btn btn-dark">Kembali</a>
                                       </div>
                                   </form>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <script src="{{ asset('apps/genangan/form.js') }}"></script>
   @endsection
