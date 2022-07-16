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
               <div class="row">
                   <div class="col-12">
                       <div class="card">
                           <div class="card-header">
                               <a href="{{ route('drainase2022.create') }}" class="btn btn-primary">Tambah Baru</a>
                           </div>
                           <div class="card-body">
                               <div class="table-responsive">
                                   <table id="datatable" class="display" style="min-width: 845px">
                                       <thead>
                                           <tr>
                                               <th>No.</th>
                                               <th>Kode Saluran</th>
                                               <th>Lokasi</th>
                                               <th>Sisi</th>
                                               <th>Panjang</th>
                                               <th>Tinggi</th>
                                               <th>Kondisi Fisik</th>
                                               <th>Aksi</th>
                                           </tr>
                                       </thead>
                                       <tbody>


                                       </tbody>
                                   </table>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>

       <script src="{{ asset('apps/drainase2022/index.js') }}"></script>
   @endsection
