  @extends('layouts.main')
  @section('content')
      <div class="content-body">
          <!-- row -->
          <div class="container-fluid">

              <div class="row">
                  <div class="col-xl-3 col-xxl-3 col-sm-6">
                      <div class="widget-stat card bg-primary overflow-hidden">
                          <div class="card-header">
                              <h3 class="card-title text-white">Total Students</h3>
                              <h5 class="text-white mb-0"><i class="fa fa-caret-up"></i> 422</h5>
                          </div>
                          <div class="card-body text-center mt-3">
                          </div>
                      </div>
                  </div>
                  <div class="col-xl-3 col-xxl-3 col-sm-6">
                      <div class="widget-stat card bg-success overflow-hidden">
                          <div class="card-header">
                              <h3 class="card-title text-white">New Students</h3>
                              <h5 class="text-white mb-0"><i class="fa fa-caret-up"></i> 357</h5>
                          </div>
                          <div class="card-body text-center mt-4 p-0">
                          </div>
                      </div>
                  </div>
                  <div class="col-xl-3 col-xxl-3 col-sm-6">
                      <div class="widget-stat card bg-secondary overflow-hidden">
                          <div class="card-header pb-3">
                              <h3 class="card-title text-white">Total Course</h3>
                              <h5 class="text-white mb-0"><i class="fa fa-caret-up"></i> 547</h5>
                          </div>
                          <div class="card-body p-0 mt-2">
                          </div>
                      </div>
                  </div>
                  <div class="col-xl-3 col-xxl-3 col-sm-6">
                      <div class="widget-stat card bg-danger overflow-hidden">
                          <div class="card-header pb-3">
                              <h3 class="card-title text-white">Fees Collection</h3>
                              <h5 class="text-white mb-0"><i class="fa fa-caret-up"></i> 3280$</h5>
                          </div>
                          <div class="card-body p-0 mt-1">
                          </div>
                      </div>
                  </div>
                  <div class="col-xl-6 col-xxl-6 col-sm-6">
                      <div class="card">
                          <div class="card-header">
                              <h3 class="card-title">Income/Expense Report</h3>
                          </div>
                          <div class="card-body">
                              <canvas id="barChart_2"></canvas>
                          </div>
                      </div>
                  </div>
                  <div class="col-xl-6 col-xxl-6 col-sm-6">
                      <div class="card">
                          <div class="card-header">
                              <h3 class="card-title">Income/Expense Report</h3>
                          </div>
                          <div class="card-body">
                              <canvas id="areaChart_1"></canvas>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  @endsection
