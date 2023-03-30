@extends('layouts.master-dashboard')

@push('css')
    <!-- css for this page only -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

@endpush


@section('content')

<div class="section-header">
    <div class="tab-content">
        <div id="nav-pills-component" class="tab-pane tab-example-result fade show active" role="tabpanel" aria-labelledby="nav-pills-component-tab">
          <ul class="nav nav-pills nav-fill flex-column flex-sm-row" id="tabs-text" role="tablist">
            <li class="nav-item">
                <a href="{{route('peminjaman.index')}}" class="nav-link mb-sm-3 mb-md-0 {{(request()->is('manajement-ruangan/peminjaman*')) ? 'active': ''}}" id="tabs-create-peminjaman" aria-controls="tabs-create-peminjaman" aria-selected="true">Buat Pengajuan</a>
            </li>
            <li class="nav-item">
              <a href="{{route('pengajuan.index')}}" class="nav-link mb-sm-3 mb-md-0 {{(request()->is('manajement-ruangan/pengajuan*')) ? 'active': ''}} " id="tabs-pengajuan" aria-controls="tabs-pengajuan" aria-selected="false">Data Pengajuan</a>
            </li>
            <li class="nav-item">
              <a href="{{route('booking.index')}}" class="nav-link mb-sm-3 mb-md-0 {{(request()->is('manajement-ruangan/booking*')) ? 'active': ''}} " id="tabs-dibooking"  aria-controls="tabs-dibooking" aria-selected="false">Data Dibooking</a>
            </li>
          </ul>
        </div>
    </div>
</div>
<div class="section-body">
    <h2 class="section-title">Data Pengajuan Peminjaman Ruangan.</h2>
    <p class="section-lead">
       Berikut merupakan data pengajuan peminjaman ruangan.
    </p>

    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">

                <div class="card">
                    <!-- Card body -->
                    <div class="card-body">
                        {{ $dataTable->table() }}
                    </div>
                </div>

        </div>
    </div>
</div>

@endsection

@push('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="modalAction">
    <div class="modal-dialog" role="document">
   
    </div>
</div>
@endpush

@push('scripts')
<!-- js for this page only -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{ $dataTable->scripts()}}

<script>

    $('#peminjaman-table').on('click','.action', function(){
        let data = $(this).data()
        let id = data.id
        let jenis = data.jenis

        if(jenis == 'delete'){

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method  : 'DELETE',
                        url     : `/manajement-ruangan/pengajuan/`+id+ `/delete`,
                        headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend:function()
                        {
                        $('#overlay').fadeIn(300);
                        },
                        success : function(res){
                            Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                            )
                            $('#overlay').fadeOut(300);
                            $('#peminjaman-table').DataTable().ajax.reload();
                        },
                        error: function () {
                            Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                            )
                            $('#overlay').fadeOut(300);
                             $('#peminjaman-table').DataTable().ajax.reload();
                        }
                    })

                }
            })
            return
        }

        if(jenis == 'accept'){

            Swal.fire({
                title: 'Are you sure?',
                text: "To Accept Submissions",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Accept'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method  : 'get',
                        url     : `/manajement-ruangan/pengajuan/`+id+ `/accept`,
                        headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend:function()
                        {
                        $('#overlay').fadeIn(300);
                        },
                        success : function(res){
                            Swal.fire(
                            'Accepting!',
                            'Your subbmissions has been Accept.',
                            'success'
                            )
                            $('#overlay').fadeOut(300);
                            $('#peminjaman-table').DataTable().ajax.reload();
                        },
                        error: function () {
                            Swal.fire(
                            'Accepting!',
                            'Your subbmissions has been Accept.',
                            'success'
                            )
                            $('#overlay').fadeOut(300);
                            $('#peminjaman-table').DataTable().ajax.reload();
                        }
                    })

                }
            })
            return
        }
        
        if(jenis == 'disaccept'){

            Swal.fire({
                title: 'Are you sure?',
                text: "To Disaccept Submissions",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Accept'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method  : 'get',
                        url     : `/manajement-ruangan/pengajuan/`+id+ `/disaccept`,
                        headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend:function()
                        {
                        $('#overlay').fadeIn(300);
                        },
                        success : function(res){
                            Swal.fire(
                            'Disaccepting!',
                            'Your subbmissions has been Accept.',
                            'success'
                            )
                            $('#overlay').fadeOut(300);
                            $('#peminjaman-table').DataTable().ajax.reload();
                        },
                        error: function () {
                            Swal.fire(
                            'Disaccepting!',
                            'Your subbmissions has been Accept.',
                            'success'
                            )
                            $('#overlay').fadeOut(300);
                            $('#peminjaman-table').DataTable().ajax.reload();
                        }
                    })

                }
            })
            return
        }

        if(jenis == 'edit'){
            $.ajax({
                method  : 'get',
                url     : `/manajement-ruangan/pengajuan/`+id+ `/edit`,
                beforeSend:function()
                        {
                        $('#overlay').fadeIn(300);
                        },
                success : function(res){
                    // console.log(res)
                    $('#modalAction').find('.modal-dialog').html(res)
                    $('#modalAction').modal('show')
                    $('#overlay').fadeOut(300);
                    $('#peminjaman-table').DataTable().ajax.reload();
                }
            })

        }

    })

</script>
@endpush
