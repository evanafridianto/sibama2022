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
                           <li class="breadcrumb-item"><a href="{{ route('kelurahan.index') }}">Data Kelurahan</a>
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
                                   <form id="kelurahan-form">
                                       <div class="form-row">
                                           <div class="col-md-12 col-sm-12">
                                               <div class="form-group">
                                                   <label>Nama Kelurahan</label>
                                                   <input type="hidden" class="form-control"
                                                       value="{{ Route::is('kelurahan.edit') ? $kelurahan->id : '' }}"
                                                       name="id">
                                                   <input type="text" class="form-control"
                                                       value="{{ Route::is('kelurahan.edit') ? $kelurahan->nama : '' }}"
                                                       name="nama" placeholder="Nama Kelurahan">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="form-row">
                                           <div class="col-md-12 col-sm-12">
                                               <div class="form-group">
                                                   <label>Kecamatan</label>
                                                   <select class="form-control" name="kecamatan">
                                                       <option value="">Pilih Kecamatan</option>
                                                       @foreach ($kecamatan as $item)
                                                           <option
                                                               {{ Route::is('kelurahan.edit') && $item->id == $kelurahan->kecamatan_id ? 'selected' : '' }}
                                                               value="{{ $item->id }}">{{ $item->nama }}</option>
                                                       @endforeach
                                                   </select>
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="btn-list">
                                           <button type="submit" class="btn btn-primary">Submit</button>
                                           <a href="{{ route('kelurahan.index') }}" class="btn btn-dark">Kembali</a>
                                       </div>
                                   </form>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <script src="{{ asset('apps/kelurahan/form.js') }}"></script>
   @endsection
