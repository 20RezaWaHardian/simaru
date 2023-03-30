@extends('layouts.master-dashboard')

@push('css')
    <!-- css for this page only -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    
@endpush

@section('content')
<div class="section-header">
    <h1>Manajement Role</h1>
</div>
<div class="section-body">
    <h2 class="section-title">DATA ROLES</h2>
    <p class="section-lead">
        Roles dibutuhkan untuk memberikan atau membatasi akses bagi pengguna sistem.
    </p>

    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
            <h4>ROLES SISTEM</h4>
                @if(auth()->user()->can('create manajement/roles'))
                    <div class="card-header-form">               
                        <button type="button" class="btn btn-sm btn-primary tambah-data">Tambah Role</button>
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
    <div class="modal-dialog modal-lg" role="document">
   
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalSetPermission">
    <div class="modal-dialog modal-lg" role="document">
   
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalSetHakAkses">
    <div class="modal-dialog modal-lg" role="document">
   
    </div>
</div>


@endpush

@push('scripts')
<!-- js for this page only -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{ $dataTable->scripts()}}

<script>
    // var table = $('#role-table').Datatable();
   


    $('.tambah-data').on('click', function(){
        $.ajax({
            method  : 'get',
            url     : `{{ url('/manajement/roles/create')}}`,
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
                data:formData,
                processData :false,
                contentType :false,
                success : function(res){
                    $('#role-table').DataTable().ajax.reload();
                    $('#modalAction').modal('hide')
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

    $('#role-table').on('click','.action', function(){
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
                        url     : `/manajement/roles/`+id+ `/delete`,
                        headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success : function(res){
                            $('#modalAction').find('.modal-dialog').html(res)
                            Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                            )
                            $('#role-table').DataTable().ajax.reload();
                        }
                    })
                   
                }
            })
            return
        }

    
        if(jenis == 'edit'){
            $.ajax({
                method  : 'get',
                url     : `/manajement/roles/`+id+ `/edit`,
                success : function(res){
                    // console.log(res)
                    $('#modalAction').find('.modal-dialog').html(res)
                    $('#modalAction').modal('show')
                    store()
                }
            })
   
        }

        if(jenis == 'set-permission'){
            $.ajax({
            method  : 'get',
            url     : `/manajement/roles/`+id+ `/set-permission`,
            success : function(res){
                // console.log(res)
                $('#modalSetPermission').find('.modal-dialog').html(res)
                $('#modalSetPermission').modal('show')
                store()
            }
        })
        }

        if(jenis == 'set-hak-akses'){
            $.ajax({
            method  : 'get',
            url     : `/manajement/roles/`+id+ `/set-hak-akses`,
            success : function(res){
                // console.log(res)
                $('#modalSetHakAkses').find('.modal-dialog').html(res)
                $('#modalSetHakAkses').modal('show')
                store()
            }
        })
        }
    })
   
</script>
@endpush