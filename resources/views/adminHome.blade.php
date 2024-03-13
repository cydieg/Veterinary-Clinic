@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')
<div class="main-container">
    <div class="pd-ltr-20">
        <div class="card-box pd-20 height-100-p mb-30">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <img src="/back/vendors/images/banner-img.png" alt="" />
                </div>
                <div class="col-md-8">
                    <h4 class="font-20 weight-500 mb-10 text-capitalize">
                        Welcome back
                        <div class="weight-600 font-30 text-blue">Cydie Gargullo!</div>
                    </h4>
                    <p class="font-18 max-width-600">
                        eMed is committed to providing quality healthcare services and products. 
                        Our experienced pharmacists are dedicated to ensuring you receive the best possible care for your health needs.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 mb-30">
                <div class="card-box height-100-p widget-style1">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="progress-data">
                            <div id="chart"></div>
                        </div>
                        <div class="widget-data">
                            <div class="h4 mb-0">2020</div>
                            <div class="weight-600 font-14">Naujan</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 mb-30">
                <div class="card-box height-100-p widget-style1">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="progress-data">
                            <div id="chart2"></div>
                        </div>
                        <div class="widget-data">
                            <div class="h4 mb-0">400</div>
                            <div class="weight-600 font-14">Victoria</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 mb-30">
                <div class="card-box height-100-p widget-style1">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="progress-data">
                            <div id="chart3"></div>
                        </div>
                        <div class="widget-data">
                            <div class="h4 mb-0">350</div>
                            <div class="weight-600 font-14">Calapan</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 mb-30">
                <div class="card-box height-100-p widget-style1">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="progress-data">
                            <div id="chart4"></div>
                        </div>
                        <div class="widget-data">
                            <div class="h4 mb-0">6060</div>
                            <div class="weight-600 font-14">Pinamalayan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8 mb-30">
                <div class="card-box height-100-p pd-20">
                    <h2 class="h4 mb-20">Statistics</h2>
                    <div id="chart5"></div>
                </div>
            </div>
            <div class="col-xl-4 mb-30">
                <div class="card-box height-100-p pd-20">
                    <h2 class="h4 mb-20"> Predictive Analysis</h2>
                    <div id="chart6"></div>
                </div>
            </div>
        </div>
        <div class="card-box mb-30">
            <h2 class="h4 pd-20">Best Selling Products</h2>
            <table class="data-table table nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">Product</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="table-plus">
                            <img
                                src="/back/vendors/images/biogesic.jfif"
                                width="70"
                                height="70"
                                alt=""
                            />
                        </td>
                        <td>
                            <h5 class="font-16">Biogesic</h5>
                    
                        </td>
                        <td>ck nbkj</td>
                        <td>ahjcfgv</td>
                        <td>
                            <div class="dropdown">
                                <a
                                    class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                    href="#"
                                    role="button"
                                    data-toggle="dropdown"
                                >
                                    <i class="dw dw-more"></i>
                                </a>
                                <div
                                    class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
                                >
                                    <a class="dropdown-item" href="#"
                                        ><i class="dw dw-eye"></i> View</a
                                    >
                                    <a class="dropdown-item" href="#"
                                        ><i class="dw dw-edit2"></i> Edit</a
                                    >
                                    <a class="dropdown-item" href="#"
                                        ><i class="dw dw-delete-3"></i> Delete</a
                                    >
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-plus">
                            <img
                                src="/back/vendors/images/robitussin.jfif"
                                width="70"
                                height="70"
                                alt=""
                            />
                        </td>
                        <td>
                            <h5 class="font-16">Robitussin</h5>
                        </td>
                        <td>jdhv</td>
                        <td>900</td>
        
                        <td>
                            <div class="dropdown">
                                <a
                                    class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                    href="#"
                                    role="button"
                                    data-toggle="dropdown"
                                >
                                    <i class="dw dw-more"></i>
                                </a>
                                <div
                                    class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
                                >
                                    <a class="dropdown-item" href="#"
                                        ><i class="dw dw-eye"></i> View</a
                                    >
                                    <a class="dropdown-item" href="#"
                                        ><i class="dw dw-edit2"></i> Edit</a
                                    >
                                    <a class="dropdown-item" href="#"
                                        ><i class="dw dw-delete-3"></i> Delete</a
                                    >
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-plus">
                            <img
                                src="/back/vendors/images/solmux.jfif"
                                width="70"
                                height="70"
                                alt=""
                            />
                        </td>
                        <td>
                            <h5 class="font-16">Solmux</h5>
    
                        </td>
                        <td>Bababu</td>
                        <td>100</td>
                    
                        <td>
                            <div class="dropdown">
                                <a
                                    class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                    href="#"
                                    role="button"
                                    data-toggle="dropdown"
                                >
                                    <i class="dw dw-more"></i>
                                </a>
                                <div
                                    class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
                                >
                                    <a class="dropdown-item" href="#"
                                        ><i class="dw dw-eye"></i> View</a
                                    >
                                    <a class="dropdown-item" href="#"
                                        ><i class="dw dw-edit2"></i> Edit</a
                                    >
                                    <a class="dropdown-item" href="#"
                                        ><i class="dw dw-delete-3"></i> Delete</a
                                    >
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-plus">
                            <img
                                src="/back/vendors/images/neozep.jfif"
                                width="70"
                                height="70"
                                alt=""
                            />
                        </td>
                        <td>
                            <h5 class="font-16">Neozep</h5>
                    
                        </td>
                        <td>Urbaniotic Acid</td>
                        <td>30</td>
                    
                        <td>
                            <div class="dropdown">
                                <a
                                    class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                    href="#"
                                    role="button"
                                    data-toggle="dropdown"
                                >
                                    <i class="dw dw-more"></i>
                                </a>
                                <div
                                    class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
                                >
                                    <a class="dropdown-item" href="#"
                                        ><i class="dw dw-eye"></i> View</a
                                    >
                                    <a class="dropdown-item" href="#"
                                        ><i class="dw dw-edit2"></i> Edit</a
                                    >
                                    <a class="dropdown-item" href="#"
                                        ><i class="dw dw-delete-3"></i> Delete</a
                                    >
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-plus">
                            <img
                                src="/back/vendors/images/paracetamol.jfif"
                                width="70"
                                height="70"
                                alt=""
                            />
                        </td>
                        <td>
                            <h5 class="font-16">Paracetamol</h5>
                            
                        </td>
                        <td>Reduce headache</td>
                        <td>120</td>
                        
                        <td>
                            <div class="dropdown">
                                <a
                                    class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                    href="#"
                                    role="button"
                                    data-toggle="dropdown"
                                >
                                    <i class="dw dw-more"></i>
                                </a>
                                <div
                                    class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
                                >
                                    <a class="dropdown-item" href="#"
                                        ><i class="dw dw-eye"></i> View</a
                                    >
                                    <a class="dropdown-item" href="#"
                                        ><i class="dw dw-edit2"></i> Edit</a
                                    >
                                    <a class="dropdown-item" href="#"
                                        ><i class="dw dw-delete-3"></i> Delete</a
                                    >
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
@endsection