
@extends('layouts.master-dashboard')

@push('css')
    <!-- css for this page only -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet"  href="{{asset('assets/component/select2/select2.min.css')}}">
@endpush

@section('content')
<div class="section-header">
    <h5><font style="font-weight: bold;">PROGRAM STUDI </font></h5>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-4">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>Jumlah Program Studi </h4>
                    </div>
                    <div class="card-body">
                        {{$prodi}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-8 col-sm-8 col-8">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-search"></i>
                </div>
                <div class="card-wrap">

                    <div class="card-body mt-2" style="font-size: 0.875em !important">
                        <div class="row input-daterange align-items-center">
                            <div class="col">
                                <div class="form-group">
                                    <label>Filter Fakultas</label>
                                    <select name="fakultas_id" id="fakultas_id"  class="js-example-basic-single form-control filter">
                                    <option disabled selected >Pilih Fakultas</option>
                                    @foreach ($fakultas as $item)
                                        <option value="{{$item->id_fakultas}}">{{$item->nama_fakultas}} ({{$item->kode_fakultas}})</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                              <div class="form-group">
                                <label>Filter Semester</label>
                                <select class="js-example-basic-single form-control-label"  name="prodi_id" >
                                    <option disabled selected>Pilih Semester . . .</option>
                                    <option >x</option>
                                    <option >example</option>

                                </select>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
        </div>
    </div>
</div>
@endsection

@push('modal')
<!-- Modal create -->

@endpush

@push('scripts')
<!-- js for this page only -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('assets/component/select2/select2.min.js')}}"></script>
{{ $dataTable->scripts()}}
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

        let table = $('#prodi-table')

        $('#fakultas_id').on('change', function () {
            tableFilter($('#fakultas_id').val())
            table.DataTable().ajax.reload()
        })
        // $('#reset').on('click', function () {
        //     tableFilter(null)
        //     table.DataTable().ajax.reload()
        // })

        function tableFilter(value) {
            table.on('preXhr.dt', function ( e, settings, data ) {
                data.fakultas_id = value;
            })
        }

    });

    $('#prodi-table').on('click','.action', function(){
        let data = $(this).data()
        let id = data.id
        let jenis = data.jenis

        if(jenis == 'alokasikan'){
            $.ajax({
                method  : 'get',
                url     : `/manajement-ruangan/alokasi-ruangan/`+id+ `/alokasi`,
                success : function(res){

                    // store()
                    // $('#prodi-table').DataTable().ajax.reload();
                }
            })

        }

    })



</script>


@endpush

