
@extends('layouts.master-dashboard')

@push('css')
    <!-- css for this page only -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet"  href="{{asset('assets/component/select2/select2.min.css')}}">
@endpush

@section('content')
<div class="section-header">
    <h5><font style="font-weight: bold;">PROGRAM STUDI {{ Str::upper($prodi->nama_prodi)}}</font></h5>
</div>
<div class="section-body">
    <h4 class="section-title">ALOKASIKAN RUANGAN </h4>
    <p class="section-lead">
        Alokasi Ruangan dapat di tambah sesusai keinginan anda.
    </p>

    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); border-radius:5px">
                <div class="card-headers mt-3 px-4">
                    <div class="text-left">
                        <a href={{route('alokasi-ruangan.index')}} class="btn btn-icon btn-3 btn-primary ">
                            <span class="btn-inner--icon"><i class="fa fa-arrow-left"></i></span>
                          <span class="btn-inner--text"> Kembali</span>
                        </a>
                        <a href={{route('alokasi-ruangan.show',$prodi->id_prodi)}} class="btn btn-icon btn-3 btn-info ">
                            <span class="btn-inner--icon"><i class="fa fa-list"></i></span>
                          <span class="btn-inner--text"> Lihat Alokasi</span>
                        </a>


                    </div>
                </div>
                <form action="{{route('alokasi-ruangan.store')}}" method="POST">
                @csrf
                    <div class="card-body">
                        <input type="hidden" value="{{encrypt($prodi->id_prodi)}}" name="secret">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="exampleFormControlSelect1">Pilih Ruangan<small style="color:red">*</small></label>
                                        <select class="js-example-basic-single form-control"  name="ruangan_id"  required>
                                            <option disabled selected>Data Ruangan . . .</option>
                                            @foreach($data_ruangan as $ruangan)
                                                <option value="{{encrypt($ruangan->id)}}">{{$ruangan->nama_ruangan}} ( {{ $ruangan->gedung->nama_gedung }})</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="exampleFormControlSelect1">Pilih Hari<small style="color:red">*</small></label>
                                        <select class="js-example-basic-single form-control"  name="hari"   required>
                                            <option disabled selected>Data Hari . . .</option>
                                            <option value="1">Senin</option>
                                            <option value="2">Selasa</option>
                                            <option value="3">Rabu</option>
                                            <option value="4">Kamis</option>
                                            <option value="5">Jumat</option>
                                            <option value="6">Sabtu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
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
                    <div class="card-footer align-right">
                        <div class="text-right">
                            <button class="btn btn-icon btn-3 btn-primary " type="submit">
                                <span class="btn-inner--icon"><i class="fas fa-save"></i></span>
                                <span class="btn-inner--text">Alokasikan</span>
                            </button>

                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection

@push('modal')


@endpush

@push('scripts')
<!-- js for this page only -->

<script src="{{asset('assets/component/select2/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

    });
</script>

@endpush

