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
                           <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Data Kategori</a>
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
                                   <form id="kategori-form">
                                       <div class="form-row">
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Nama Kategori</label>
                                                   <input type="hidden" class="form-control"
                                                       value="{{ Route::is('kategori.edit') ? $kategori->id : '' }}"
                                                       name="id">
                                                   <input type="text" class="form-control"
                                                       value="{{ Route::is('kategori.edit') ? $kategori->nama : '' }}"
                                                       name="nama" placeholder="Nama Kategori">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Kategori Induk</label>
                                                   <select class="form-control" name="induk">
                                                       <option value="">Pilih Kategori Induk</option>
                                                       <option
                                                           {{ Route::is('kategori.edit') && $kategori->induk == 'Kondisi Fisik' ? 'selected' : '' }}
                                                           value="Kondisi Fisik">Kondisi Fisik</option>
                                                       <option
                                                           {{ Route::is('kategori.edit') && $kategori->induk == 'Kondisi Sedimen' ? 'selected' : '' }}
                                                           value="Kondisi Sedimen">Kondisi Sedimen</option>
                                                       <option
                                                           {{ Route::is('kategori.edit') && $kategori->induk == 'Penanganan' ? 'selected' : '' }}
                                                           value="Penanganan">Penanganan</option>
                                                   </select>
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="btn-list">
                                           <button type="submit" class="btn btn-primary">Submit</button>
                                           <a href="{{ route('kategori.index') }}" class="btn btn-dark">Kembali</a>
                                       </div>
                                   </form>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <script src="{{ asset('apps/kategori/form.js') }}"></script>
   @endsection
