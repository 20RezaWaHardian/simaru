<?php
    use App\Helpers\MyHelpers;
?>
@extends('layouts.master-dashboard')

@push('css')
    <!-- css for this page only -->
    <link rel="stylesheet"  href="{{asset('assets/component/select2/select2.min.css')}}">

    
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
    <h2 class="section-title">Form Pengajuan Peminjaman Ruangan.</h2>
    <p class="section-lead">
        Silahkan isi form pengajuan peminjaman berikut untuk dapat meminjam ruangan.
    </p>

    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form class="needs-validation" action="{{route('peminjaman.store')}}" enctype="multipart/form-data" method="post" novalidate>
                @csrf
                <!-- Custom form validation -->
                <div class="card">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                @role('dosen')
                                <label class="form-control-label" for="exampleFormControlSelect1">Nama Peminjam<small style="color:red">*</small></label>
                                <input type="text" name="peminjam_id" class="form-control" id="validationCustom01" readonly value="{{Auth::user()->username}}" required>
                                @elserole(['developer','operator','admin'])
                                <label class="form-control-label" for="exampleFormControlSelect1">Nama Peminjam<small style="color:red">*</small></label>
                                <select class="js-example-basic-single form-control" required  name="peminjam_id" >
                                    <option disabled selected>Pilih Peminjam . . .</option>
                                    @foreach($data_peminjam as $peminjam)
                                        <option value="{{$peminjam->nip_baru}}">{{ MyHelpers::nama_gelar($peminjam) }}</option>
                                    @endforeach
                                </select>
                                @endrole
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-control-label" for="exampleFormControlSelect1">Pilih Ruangan<small style="color:red">*</small></label>
                                <select class="js-example-basic-single form-control"  name="ruangan_id"   required>
                                    <option disabled selected>Data Ruangan . . .</option>
                                    @foreach($data_ruangan as $ruangan)
                                        <option value="{{$ruangan->id}}">{{$ruangan->nama_ruangan}} ( {{ $ruangan->gedung->nama_gedung }})</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label class="form-control-label" for="validationCustom01">Nama Kegiatan<small style="color:red">*</small></label>
                                <input type="text" name="nama_kegiatan" class="form-control" id="validationCustom01" required>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="col-md-2 mb-3">
                                <label class="form-control-label" for="validationCustom01">Estimasi Peserta<small style="color:red">*</small></label>
                                <div class="input-group">
                                    <input type="number" class="form-control" min='0' required id="validationDefaultUsername" placeholder="Angka" aria-describedby="inputGroupPrepend1" name="estimasi_peserta">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend1">Orang</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-control-label" for="validationCustom01">Tanggal Mulai Kegiatan<small style="color:red">*</small></label>
                                <input type="date" name="tanggal_mulai_kegiatan" class="form-control" id="validationCustom01" required>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-control-label" for="validationCustom01">Waktu<small style="color:red">*</small></label>
                                <input id="timepicker" name="waktu_mulai_kegiatan" class="form-control"   required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-control-label" for="validationCustom01">Tanggal Selesai Kegiatan<small style="color:red">*</small></label>
                                <input type="date" name="tanggal_selesai_kegiatan" class="form-control" id="validationCustom01" required>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-control-label" for="validationCustom01">Waktu<small style="color:red">*</small></label>
                                <input id="timepicker2" name="waktu_selesai_kegiatan" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="col-md-4 mb-3">
                                <label class="form-control-label" for="exampleFormControlSelect1">Pilih Unit Pengguna<small style="color:red">*</small></label>
                                <select class="js-example-basic-single form-control"  name="unit_pengguna" >
                                    <option disabled selected>Data Unit . . .</option>
                                    @foreach($data_unit_pengguna as $unit_pengguna)
                                        <option value="{{$unit_pengguna->nama_ref_unit_lengkap ?? $unit_pengguna->nama_ref_unit_kerja}}">{{ $unit_pengguna->nama_ref_unit_lengkap ?? $unit_pengguna->nama_ref_unit_kerja }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-control-label" for="validationCustom01">Penanggung Jawab Ruangan<small style="color:red">*</small></label>
                                <input type="text" name="penanggung_jawab_ruangan" class="form-control" placeholder="Masukkan Nama" id="validationCustom01" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-control-label" for="validationCustom01">Penanggung Jawab Pengguna<small style="color:red">*</small></label>
                                <input type="text" name="penanggung_jawab_pengguna" class="form-control" placeholder="Masukkan Nama" id="validationCustom01" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label class="form-control-label" for="exampleFormControlTextarea1">Keterangan (Optional)</label>
                                <textarea name="keterangan" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <input type="file" name="dokumen_peminjaman" class="custom-file-input" id="customFileLang" lang="en">
                                <label class="custom-file-label" for="customFileLang">Pilih Surat (Optional)</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <button class="btn btn-md bg-primary" style="color:white" type="submit">Simpan Peminjaman</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{asset('assets/component/select2/select2.min.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

    });
</script>

<script>
    $('#timepicker').timepicker();
</script>
<script>
    $('#timepicker2').timepicker();
</script>


@endpush
