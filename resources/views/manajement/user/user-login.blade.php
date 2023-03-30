<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Data User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
   
    <div class="modal-body">
        
        <div class="row" >
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Silakan Pilih User</h4>
                    </div>
 
                    <div class="card-body">
                        {{ $dataTable->table() }}
                    </div> 
               
                </div> 
            </div> 
        </div> 

    </div>
    <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
   
</div>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{ $dataTable->scripts()}}
<script>
    $('#login-table').on('click','.action', function(){
        let data = $(this).data()
        let id = data.id
        let jenis = data.jenis
        // console.log(jenis)

        if(jenis == 'login-as'){
            Swal.fire({
                title: 'Apakah Anda Yakin ?',
                text: "Meninggalkan Halaman Ini!",
                icon: 'info',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText:  '<i class="fa-solid fa-right-to-bracket"></i> Login',
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method  : 'GET',
                        url     : `/manajement/users/`+id+ `/login`,
                        headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success : function(res){
                            $('#modalLogin').modal('hide')
                            Swal.fire(
                            'Login!',
                            'Anda Berhasil Login.',
                            'success'
                            )
                            window.location.href = '/dashboard';
                        },
                        error: function(res){
                            $('#modalLogin').modal('hide')
                            Swal.fire(
                            'Login!',
                            'Anda Tidak Dapat Login.',
                            'error'
                            )
                        }
                    })
                   
                }
            })
            return
        }
    });

</script>
