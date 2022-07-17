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
                           <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $title }}</a></li>
                       </ol>
                   </div>
               </div>
               <div class="row d-flex justify-content-center">
                   <div class="col-6">
                       <div class="card">
                           <div class="card-body">
                               <div class="basic-form">
                                   <form id="r24-form">
                                       <div class="form-row">
                                           <div class="col-md-12 col-sm-12">
                                               <div class="form-group">
                                                   <label>Curah Hujan (mm)</label>
                                                   <input type="hidden" class="form-control"
                                                       value="{{ Route::is('r24.edit') ? $r24->id : '' }}" name="id">
                                                   <input type="text" class="form-control"
                                                       value="{{ Route::is('r24.edit') ? $r24->curah_hujan : '' }}"
                                                       name="curah_hujan" placeholder="Curah Hujan (mm)">
                                                   <small class="text-danger"></small>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="btn-list">
                                           <button type="submit" class="btn btn-primary">Submit</button>
                                           <a href="{{ route('dashboard') }}" class="btn btn-dark">Kembali</a>
                                       </div>
                                   </form>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <script src="{{ asset('apps/r24/form.js') }}"></script>
   @endsection
