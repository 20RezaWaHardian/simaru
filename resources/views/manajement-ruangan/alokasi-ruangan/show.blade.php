
@extends('layouts.master-dashboard')

@push('css')
    <!-- css for this page only -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet"  href="{{asset('assets/component/select2/select2.min.css')}}">
@endpush

@section('content')
<div class="section-header">
    <h5>LIST ALOKASI RUANGAN PADA PRODI {{Str::upper($prodi->nama_prodi)}}</h5>
</div>
<div class="section-body">

    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">

            <div class="card-header-form mt-3 px-4">
                <div class="text-left">
                    <a href={{route('alokasi-ruangan.create', $prodi->id_prodi)}} class="btn btn-icon btn-3 btn-primary ">
                        <span class="btn-inner--icon"><i class="fa fa-arrow-left"></i></span>
                      <span class="btn-inner--text"> Kembali</span>
                    </a>
                </div>
            </div>
            </div>

            <div class="card-body">
                <div class="table-responsive py-1">
                    <table class="table align-items-center">
                        <thead class="thead-light">
                            <tr style="text-align: center;">
                                @foreach($header as $item)
                                    <th>{{$item}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="list">
                            <tr>

                                @foreach($data_ruangan as $ruangan => $item_ruangan)
                                <td rowspan="7">{{$item_ruangan->nama_ruangan}}</td>

                                    @foreach($data_hari as $key => $item_hari)
                                    <tr>
                                        @if(in_array($key, [2,4,6]))
                                            <td style="background-color: rgb(241, 252, 252);"> {{$item_hari}}</td>
                                        @else
                                            <td> {{$item_hari}}</td>
                                        @endif



                                                <?php
                                                    // $alokasiKu=[];
                                                ?>
                                                @foreach($data_alokasi->where('ruangan_id',$item_ruangan->id)->where('hari',$key) as $key2 => $item_alokasi)
                                                   <?php
                                                    // $alokasiKu1['prodi_id'][$key2]=$item_alokasi->prodi_id;
                                                    // $alokasiKu1['ruangan_id'][$key2]=$item_alokasi->ruangan_id;
                                                    // $alokasiKu1['hari'][$key2]=$item_alokasi->hari;
                                                    ?>

                                                    @if($item_alokasi->j6)
                                                        <td style="background-color: rgb(150, 219, 236);"></td>
                                                    @else
                                                        <td style="background-color:rgb(201, 197, 197)"></td>
                                                    @endif
                                                    @if($item_alokasi->j7)
                                                        <td style="background-color: rgb(150, 219, 236);"></td>
                                                    @else
                                                        <td style="background-color: rgb(201, 197, 197)"></td>
                                                    @endif
                                                    @if($item_alokasi->j8)
                                                        <td style="background-color: rgb(150, 219, 236);"></td>
                                                    @else
                                                        <td style="background-color:rgb(201, 197, 197)"></td>
                                                    @endif
                                                    @if($item_alokasi->j9)
                                                        <td style="background-color: rgb(150, 219, 236);"></td>
                                                    @else
                                                        <td style="background-color:rgb(201, 197, 197)"></td>
                                                    @endif
                                                    @if($item_alokasi->j10)
                                                        <td style="background-color: rgb(150, 219, 236);"></td>
                                                    @else
                                                        <td style="background-color:rgb(201, 197, 197)"></td>
                                                    @endif
                                                    @if($item_alokasi->j11)
                                                        <td style="background-color: rgb(150, 219, 236);"></td>
                                                    @else
                                                        <td style="background-color:rgb(201, 197, 197)"></td>
                                                    @endif
                                                    @if($item_alokasi->j12)
                                                        <td style="background-color: rgb(150, 219, 236);"></td>
                                                    @else
                                                        <td style="background-color:rgb(201, 197, 197)"></td>
                                                    @endif
                                                    @if($item_alokasi->j13)
                                                        <td style="background-color: rgb(150, 219, 236);"></td>
                                                    @else
                                                        <td style="background-color:rgb(201, 197, 197)"></td>
                                                    @endif
                                                    @if($item_alokasi->j14)
                                                        <td style="background-color: rgb(150, 219, 236);"></td>
                                                    @else
                                                        <td style="background-color:rgb(201, 197, 197)"></td>
                                                    @endif
                                                    @if($item_alokasi->j15)
                                                        <td style="background-color: rgb(150, 219, 236);"></td>
                                                    @else
                                                        <td style="background-color:rgb(201, 197, 197)"></td>
                                                    @endif
                                                    @if($item_alokasi->j16)
                                                        <td style="background-color: rgb(150, 219, 236);"></td>
                                                    @else
                                                        <td style="background-color:rgb(201, 197, 197)"></td>
                                                    @endif
                                                    @if($item_alokasi->j17)
                                                        <td style="background-color: rgb(150, 219, 236);"></td>
                                                    @else
                                                        <td style="background-color:rgb(201, 197, 197)"></td>
                                                    @endif
                                                    @if($item_alokasi->j18)
                                                        <td style="background-color: rgb(150, 219, 236);"></td>
                                                    @else
                                                        <td style="background-color:rgb(201, 197, 197)"></td>
                                                    @endif
                                                    @if($item_alokasi->j19)
                                                        <td style="background-color: rgb(150, 219, 236);"></td>
                                                    @else
                                                        <td style="background-color:rgb(201, 197, 197)"></td>
                                                    @endif
                                                    @if($item_alokasi->j20)
                                                        <td style="background-color: rgb(150, 219, 236);"></td>
                                                    @else
                                                        <td style="background-color:rgb(201, 197, 197)"></td>
                                                    @endif
                                                    @if($item_alokasi->j21)
                                                        <td style="background-color: rgb(150, 219, 236);"></td>
                                                    @else
                                                        <td style="background-color:rgb(201, 197, 197)"></td>
                                                    @endif
                                                    @if($item_alokasi->j22)
                                                        <td style="background-color: rgb(150, 219, 236);"></td>
                                                    @else
                                                        <td style="background-color:rgb(201, 197, 197)"></td>
                                                    @endif
                                                    @if($item_alokasi->j23)
                                                        <td style="background-color: rgb(150, 219, 236);"></td>
                                                    @else
                                                        <td style="background-color:rgb(201, 197, 197)"></td>
                                                    @endif

                                                @endforeach
                                                <?php
                                                // $alokasiKu[]=$alokasiKu1;

                                                ?>

                                        {{-- @foreach($alokasiKu as $item)

                                            @if(in_array($data_ruangan[$ruangan]->id,$item['ruangan_id']) AND in_array($prodi->id_prodi,$item['prodi_id']) AND in_array($key,$item['hari']))
                                            <td>


                                                <button type="button" data-toggle="modal" data-target="#action-alokasi"
                                                    data-ruangan_id="{{ encrypt($data_ruangan[$ruangan]->id) }}"
                                                    data-prodi_id="{{ encrypt($prodi->id_prodi)}}"
                                                    data-hari="{{ $key }}"
                                                    class="btn btn-warning btn-sm" id="alokasikan"><i class="fas fa-pencil-alt"></i></button>
                                            </td>
                                            @else
                                            <td>

                                                <button type="button" data-toggle="modal" data-target="#action-alokasi"
                                                    data-ruangan_id="{{ encrypt($data_ruangan[$ruangan]->id) }}"
                                                    data-prodi_id="{{ encrypt($prodi->id_prodi)}}"
                                                    data-hari="{{ $key }}"
                                                    class="btn btn-warning btn-sm" id="alokasikan">Tambah</button>
                                            </td>

                                            @endif
                                        @endforeach --}}
                                        <td>


                                            <button type="button" data-toggle="modal" data-target="#action-alokasi"
                                                data-ruangan_id="{{ encrypt($data_ruangan[$ruangan]->id) }}"
                                                data-prodi_id="{{ encrypt($prodi->id_prodi)}}"
                                                data-hari="{{ $key }}"
                                                class="btn btn-warning btn-sm" id="alokasikan"><i class="fas fa-pencil-alt"></i></button>
                                        </td>



                                    </tr>

                                    @endforeach
                                @endforeach

                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection

@push('modal')
<!-- Modal create -->
<div class="modal fade" id="action-alokasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Alokasikan Ruangan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('alokasi-ruangan.store')}}" method="POST">
        @csrf
        <input type="hidden" name="secret" class="secret" value="">
        <input type="hidden" name="ruangan_id" class="ruangan_id" value="">
        <input type="hidden" name="hari" class="hari" value="">
            <div class="modal-body">

                    <div class="card">
                        <div class="row">

                            <div class="col-4">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=1 name="j6" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                    Jam 06.00
                                    </label>
                                </div>
                                <div class="form-check mr-2">
                                    <input class="form-check-input" type="checkbox" value=1 name="j7" id="flexCheckChecked" >
                                    <label class="form-check-label" for="flexCheckChecked">
                                    Jam 07.00
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=1 name="j8" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                    Jam 08.00
                                    </label>
                                </div>
                                <div class="form-check mr-2">
                                    <input class="form-check-input" type="checkbox" value=1 name="j9" id="flexCheckChecked" >
                                    <label class="form-check-label" for="flexCheckChecked">
                                    Jam 09.00
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=1 name="j10" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                    Jam 10.00
                                    </label>
                                </div>
                                <div class="form-check mr-2">
                                    <input class="form-check-input" type="checkbox" value=1 name="j11" id="flexCheckChecked" >
                                    <label class="form-check-label" for="flexCheckChecked">
                                    Jam 11.00
                                    </label>

                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=1 name="j12" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                    Jam 12.00
                                    </label>
                                </div>
                                <div class="form-check mr-2">
                                    <input class="form-check-input" type="checkbox" value=1 name="j13" id="flexCheckChecked" >
                                    <label class="form-check-label" for="flexCheckChecked">
                                    Jam 13.00
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=1 name="j14" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                    Jam 14.00
                                    </label>
                                </div>
                                <div class="form-check mr-2">
                                    <input class="form-check-input" type="checkbox" value=1 name="j15" id="flexCheckChecked" >
                                    <label class="form-check-label" for="flexCheckChecked">
                                    Jam 15.00
                                    </label>
                                </div>
                                <div class="form-check mr-2">
                                    <input class="form-check-input" type="checkbox" value=1 name="j16" id="flexCheckChecked" >
                                    <label class="form-check-label" for="flexCheckChecked">
                                    Jam 16.00
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=1 name="j17" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                    Jam 17.00
                                    </label>
                                </div>

                            </div>

                            <div class="col-4">
                                <div class="form-check mr-2">
                                    <input class="form-check-input" type="checkbox" value=1 name="j18" id="flexCheckChecked" >
                                    <label class="form-check-label" for="flexCheckChecked">
                                    Jam 18.00
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=1 name="j19" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                    Jam 19.00
                                    </label>
                                </div>
                                <div class="form-check mr-2">
                                    <input class="form-check-input" type="checkbox" value=1 name="j20" id="flexCheckChecked" >
                                    <label class="form-check-label" for="flexCheckChecked">
                                    Jam 20.00
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=1 name="j21" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                    Jam 21.00
                                    </label>
                                </div>

                                <div class="form-check mr-2">
                                    <input class="form-check-input" type="checkbox" value=1 name="j22" id="flexCheckChecked" >
                                    <label class="form-check-label" for="flexCheckChecked">
                                    Jam 22.00
                                    </label>
                                </div>
                                <div class="form-check mr-2">
                                    <input class="form-check-input" type="checkbox" value=1 name="j23" id="flexCheckChecked" >
                                    <label class="form-check-label" for="flexCheckChecked">
                                    Jam 23.00
                                    </label>
                                </div>
                            </div>


                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
</div>


@endpush

@push('scripts')
<!-- js for this page only -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('assets/component/select2/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

        $(document).on('click','#alokasikan', function(){
           var secret   = $(this).data('prodi_id');
           var hari   = $(this).data('hari');
           var ruangan_id   = $(this).data('ruangan_id');


           $('.secret').val(secret);
           $('.hari').val(hari);
           $('.ruangan_id').val(ruangan_id);

       });


    });
</script>


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

