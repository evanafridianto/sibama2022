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
                           <div class="card-header">
                               <h4 class="card-title">Drainase 2022 Form</h4>
                           </div>
                           <div class="card-body">
                               <div class="basic-form">
                                   <form>
                                       <div class="form-row">
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Kode Saluran</label>
                                                   <input type="text" class="form-control" placeholder="Kode Saluran">
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Nama Jalan</label>
                                                   <input type="text" class="form-control" placeholder="Nama Jalan">
                                               </div>
                                           </div>
                                       </div>
                                       <div class="form-row">
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Kelurahan</label>
                                                   <select class="form-control">
                                                       <option value="">Pilih Kelurahan</option>
                                                       <option>Option 1</option>
                                                       <option>Option 2</option>
                                                       <option>Option 3</option>
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Kecamatan</label>
                                                   <select class="form-control">
                                                       <option value="">Pilih Kecamatan</option>
                                                       <option>Option 1</option>
                                                       <option>Option 2</option>
                                                       <option>Option 3</option>
                                                   </select>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="form-row">

                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Panjang</label>
                                                   <input type="text" class="form-control" placeholder="Panjang">
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Tinggi</label>
                                                   <input type="text" class="form-control" placeholder="Tinggi">
                                               </div>
                                           </div>
                                       </div>
                                       <div class="form-row">
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Lebar Atas</label>
                                                   <input type="text" class="form-control" placeholder="Lebar Atas">
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Lebar Bawah</label>
                                                   <input type="text" class="form-control" placeholder="Lebar Bawah">
                                               </div>
                                           </div>
                                       </div>
                                       <div class="form-row">
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Arah Aliran</label>
                                                   <input type="text" class="form-control" placeholder="Arah Aliran">
                                               </div>
                                           </div>
                                           <div class="col-md-6 col-sm-12">
                                               <div class="form-group">
                                                   <label>Tipe</label>
                                                   <input type="text" class="form-control" placeholder="Tipe">
                                               </div>
                                           </div>
                                       </div>
                                       <div class="form-row">
                                           <div class="col-md-4 col-sm-12">
                                               <div class="form-group">
                                                   <label>Kondisi Fisik</label>
                                                   <input type="text" class="form-control" placeholder="Kondisi Fisik">
                                               </div>
                                           </div>
                                           <div class="col-md-4 col-sm-12">
                                               <div class="form-group">
                                                   <label>Sisi Jalan</label>
                                                   <input type="text" class="form-control" placeholder="Sisi Jalan">
                                               </div>
                                           </div>
                                           <div class="col-md-4 col-sm-12">
                                               <div class="form-group">
                                                   <label>Foto</label>
                                                   <input type="file" class="form-control">
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
   @endsection
