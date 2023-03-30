@extends('layouts.master-dashboard')

@push('css')
    <!-- css for this page only -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

@endpush

@section('content')
<div class="section-header">
    <h1>Master Data Gedung</h1>
</div>
<div class="section-body">
    <h2 class="section-title">DATA GEDUNG</h2>
    <p class="section-lead">
        Gedung dapat di tambah sesusai keinginan anda.
    </p>

    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
            <h4>DATA GEDUNG</h4>
                @if(auth()->user()->can('create master-data/gedung'))
                    <div class="card-header-form">
                        <button type="button" class="btn btn-sm btn-primary tambah-data">Tambah Gedung</button>
                    </div>
                @endif
            </div>

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
    <div class="modal-dialog modal-md" role="document">

    </div>
</div>

@endpush

@push('scripts')
<!-- js for this page only -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{ $dataTable->scripts()}}

<script>
    // var table = $('#gedung-table').Datatable();



    $('.tambah-data').on('click', function(){
        $.ajax({
            method  : 'get',
            url     : `{{ url('/master-data/gedung/create')}}`,
            success : function(res){
                // console.log(res)
                $('#modalAction').find('.modal-dialog').html(res)
                $('#modalAction').modal('show')
                store()
            }
        })
    })

    function store(){
        $('#formAction').on('submit', function(e){
            e.preventDefault()
            const _form = this
            const formData = new FormData(_form)
            const url =$('#formAction').attr('action')

            $.ajax({
                method  : 'POST',
                url: url,
                headers : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend:function()
                {
                    $('#overlay').fadeIn(300);
                },
                data:formData,
                processData :false,
                contentType :false,
                success : function(res){
                    $('#modalAction').modal('hide')
                    $('#gedung-table').DataTable().ajax.reload();
                },
                error: function(res){
                    let errors = res.responseJSON?.errors
                    $(_form).find('.text-danger.text-small').remove()
                    if(errors){
                        for(const [key, value] of Object.entries(errors)){
                            $(`[name='${key}']`).parent().append(`<span class="text-danger text-small"> ${value} </span>`)
                        }
                    }
                }

            })
        })
    }

    $('#gedung-table').on('click','.action', function(){
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
                        url     : `/master-data/gedung/`+id+ `/delete`,
                        headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success : function(res){
                            Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                            )
                            $('#gedung-table').DataTable().ajax.reload();
                        },
                        error: function () {
                            Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                            )
                             $('#gedung-table').DataTable().ajax.reload();
                        }
                    })

                }
            })
            return
        }


        if(jenis == 'edit'){
            $.ajax({
                method  : 'get',
                url     : `/master-data/gedung/`+id+ `/edit`,
                success : function(res){
                    // console.log(res)
                    $('#modalAction').find('.modal-dialog').html(res)
                    $('#modalAction').modal('show')
                    store()
                    $('#gedung-table').DataTable().ajax.reload();
                }
            })


        }

    })

</script>
@endpush
