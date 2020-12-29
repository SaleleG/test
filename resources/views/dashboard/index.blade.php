@extends('layout.app')

@section('content')
 
    <div class="container-fluid">
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generer le Report</a>
  </div>
  <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-6 col-md-12 mb-8">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="info-box-text font-weight-bold text-danger text-uppercase mb-1">Alertes</div>
                      <div class="col-auto">
                      <div class="h5 mb-0 font-weight-bold text-gray-800">30</div>
                    </div>
                     <a href="">
                            <div class="panel-footer">
                                <span class="pull-left">Voir plus</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-6 col-md-12 mb-8">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="info-box-text font-weight-bold text-success text-uppercase mb-1">Entrees</div>
                      <div class="col-auto">
                      <div class="h5 mb-0 font-weight-bold text-gray-800">40</div>
                    </div>
                     <a href="">
                            <div class="panel-footer">
                                <span class="pull-left">Voir plus</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-6 col-md-12 mb-8">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="info-box-text font-weight-bold text-success text-uppercase mb-1">Ventes</div>
                      <div class="col-auto">
                      <div class="h5 mb-0 font-weight-bold text-gray-800">50</div>
                    </div>
                     <a href="">
                            <div class="panel-footer">
                                <span class="pull-left">Voir plus</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Pending Requests Card Example -->
            <div class="col-xl-6 col-md-12 mb-8">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="info-box-text font-weight-bold text-warning text-uppercase mb-1">Clients</div>
                      <div class="col-auto">
                      <div class="h5 mb-0 font-weight-bold text-gray-800">60</div>
                    </div>
                     <a href="">
                            <div class="panel-footer">
                                <span class="pull-left">Voir plus</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->
 </div>

@endsection
