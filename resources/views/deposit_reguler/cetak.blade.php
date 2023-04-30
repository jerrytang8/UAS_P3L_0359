<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>GoFit</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('theme/images/favicon.png') }}">
	<link href="{{ asset('theme/vendor/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <style media="all">
        body{
            margin-top:20px;
            color: #484b51;
        }
        .text-secondary-d1 {
            color: #728299!important;
        }
        .page-header {
            margin: 0 0 1rem;
            padding-bottom: 1rem;
            padding-top: .5rem;
            border-bottom: 1px dotted #e2e2e2;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-pack: justify;
            justify-content: space-between;
            -ms-flex-align: center;
            align-items: center;
        }
        .page-title {
            padding: 0;
            margin: 0;
            font-size: 1.75rem;
            font-weight: 300;
        }
        .brc-default-l1 {
            border-color: #dce9f0!important;
        }

        .ml-n1, .mx-n1 {
            margin-left: -.25rem!important;
        }
        .mr-n1, .mx-n1 {
            margin-right: -.25rem!important;
        }
        .mb-4, .my-4 {
            margin-bottom: 1.5rem!important;
        }

        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0,0,0,.1);
        }

        .text-grey-m2 {
            color: #888a8d!important;
        }

        .text-success-m2 {
            color: #86bd68!important;
        }

        .font-bolder, .text-600 {
            font-weight: 600!important;
        }

        .text-110 {
            font-size: 110%!important;
        }
        .text-blue {
            color: #478fcc!important;
        }
        .pb-25, .py-25 {
            padding-bottom: .75rem!important;
        }

        .pt-25, .py-25 {
            padding-top: .75rem!important;
        }
        .bgc-default-tp1 {
            background-color: rgba(121,169,197,.92)!important;
        }
        .bgc-default-l4, .bgc-h-default-l4:hover {
            background-color: #f3f8fa!important;
        }
        .page-header .page-tools {
            -ms-flex-item-align: end;
            align-self: flex-end;
        }

        .btn-light {
            color: #757984;
            background-color: #f5f6f9;
            border-color: #dddfe4;
        }
        .w-2 {
            width: 1rem;
        }

        .text-120 {
            font-size: 120%!important;
        }
        .text-primary-m1 {
            color: #4087d4!important;
        }

        .text-danger-m1 {
            color: #dd4949!important;
        }
        .text-blue-m2 {
            color: #68a3d5!important;
        }
        .text-150 {
            font-size: 150%!important;
        }
        .text-60 {
            font-size: 60%!important;
        }
        .text-grey-m1 {
            color: #7b7d81!important;
        }
        .align-bottom {
            vertical-align: bottom!important;
        }
    </style>
</head>
<body>
    <div class="page-content container">
        {{-- <div class="page-header text-blue-d2">
            <h1 class="page-title text-secondary-d1">
                Invoice
                <small class="page-info">
                    <i class="fa fa-angle-double-right text-80"></i>
                    ID: #111-222
                </small>
            </h1>
    
            <div class="page-tools">
                <div class="action-buttons">
                    <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="Print">
                        <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                        Print
                    </a>
                    <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="PDF">
                        <i class="mr-1 fa fa-file-pdf-o text-danger-m1 text-120 w-2"></i>
                        Export
                    </a>
                </div>
            </div>
        </div> --}}
    
        <div class="container px-0">
            <div class="row mt-2">
                <div class="col-12 col-lg-12">
                    {{-- <div class="row">
                        <div class="col-12">
                            <div class="text-center text-150">
                                <i class="fa fa-book fa-2x text-success-m2 mr-1"></i>
                                <span class="text-default-d3">Bootdey.com</span>
                            </div>
                        </div>
                    </div> --}}
                    <!-- .row -->
    
                    <hr class="row brc-default-l1 mx-n1 mb-4" />
    
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="text-black-m2">
                                <div class="my-1"><i class="fa fa-phone fa-flip-horizontal"></i> <b class="text-600">GoFit</b></div>
                                <div class="my-1">
                                    Jl. Centralpark No. 10
                                </div>
                            </div>
                            {{-- <div>
                                <span class="text-sm text-grey-m2 align-middle">To:</span>
                                <span class="text-600 text-110 text-blue align-middle">Alex Doe</span>
                            </div>
                            <div class="text-grey-m2">
                                <div class="my-1">
                                    Street, City
                                </div>
                                <div class="my-1">
                                    State, Country
                                </div>
                                <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b class="text-600">111-111-111</b></div>
                            </div> --}}
                        </div>
                        <!-- /.col -->
    
                        <div class="text-95 col-sm-8 align-self-start d-sm-flex justify-content-end">
                            <div class="my-2 col-6">
                            <div class="row">
                                <div class="col-sm-5">No Struk</div>
                                <div class="col-sm-7">:{{ $data->no_struk }}</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">Tanggal</div>
                                <div class="col-sm-7">:{{ MyHelper::tglstruk($data->tanggal) }}</div>
                            </div>
                            </div>
                            {{-- <hr class="d-sm-none" /> --}}
                            {{-- <div class="text-grey-m2">
                                <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                    Invoice
                                </div>
    
                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID:</span> #111-222</div>
    
                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span> Oct 12, 2019</div>
    
                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Status:</span> <span class="badge badge-warning badge-pill px-25">Unpaid</span></div>
                            </div> --}}
                        </div>
                        <!-- /.col -->
                    </div>
    
                    <div class="mt-4">
                        <div>
                            <div class="row mb-2 mb-sm-0 py-10">
                                <div class="d-none d-sm-block col-3 text-600">Member</div>
                                <div class="col-9">:{{ $data->member }}/{{ $data->nama_member }}</div>
                            </div>
    
                            <div class="row mb-2 mb-sm-0 py-10">
                                <div class="d-none d-sm-block col-3">Deposit</div>
                                <div class="col-9">:Rp. {{ MyHelper::nf($data->jumlah) }} ,-</div>
                            </div>
    
                            <div class="row mb-2 mb-sm-0 py-10">
                                <div class="d-none d-sm-block col-3">Bonus Deposit</div>
                                <div class="col-9">:Rp. {{ MyHelper::nf($data->bonus_deposit) }} ,-</div>
                            </div>
    
                            <div class="row mb-2 mb-sm-0 py-10">
                                <div class="d-none d-sm-block col-3">Sisa Deposit</div>
                                <div class="col-9">:Rp. {{ MyHelper::nf($data->sisa_deposit) }} ,-</div>
                            </div>
    
                            <div class="row mb-2 mb-sm-0 py-10">
                                <div class="d-none d-sm-block col-3">Total Deposit</div>
                                <div class="col-9">:Rp. {{ MyHelper::nf($data->total_deposit) }} ,-</div>
                            </div>
                                
                        </div>
    
                        <div class="row border-b-2 brc-default-l2"></div>
    
                    </div>

                    <div class="row mt-2">
                        <div class="col-sm-6"></div>
                        <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                            <div class="my-2 col-6">
                            <div class="row">
                                <div class="col-sm-12">Kasir:{{ $data->kasir }}/{{ $data->nama_kasir }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    window.print()
</script>

</body>
</html>