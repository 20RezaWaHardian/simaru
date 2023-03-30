<?php
use App\Helpers\MyHelpers;

?>
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Data Permission</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="{{ route('pengajuan.update', $pengajuan->id)}}"  enctype="multipart/form-data" method="POST">
    @csrf
    <div class="modal-body">
        <div class="card">
            <!-- Card body -->
            <div class="card-body">
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        
                        <label class="form-control-label" for="exampleFormControlSelect1">Nama Peminjam<small style="color:red">*</small></label>
                        <select class="js-example-basic-single form-control" required  name="peminjam_id" >
                            <option disabled selected>Pilih Peminjam . . .</option>
                            @foreach($data_peminjam as $peminjam)
                                <option value="{{$peminjam->nip_baru}}" {{ $peminjam->nip_baru == $pengajuan->peminjam_id ? 'selected' : '' }}>{{ MyHelpers::nama_gelar($peminjam) }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="col-md-6 mb-3">
                        <label class="form-control-label" for="exampleFormControlSelect1">Pilih Ruangan<small style="color:red">*</small></label>
                        <select class="js-example-basic-single form-control"  name="ruangan_id"   required>
                            <option disabled selected>Data Ruangan . . .</option>
                            @foreach($data_ruangan as $ruangan)
                                <option value="{{$ruangan->id}}" {{ $ruangan->id == $pengajuan->ruangan_id ? 'selected' : '' }}>{{$ruangan->nama_ruangan}} ( {{ $ruangan->gedung->nama_gedung }})</option>
                            @endforeach
                        </select>
                    </div>
    
                </div>
    
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label class="form-control-label" for="validationCustom01">Nama Kegiatan<small style="color:red">*</small></label>
                        <input type="text" name="nama_kegiatan" class="form-control" id="validationCustom01" value="{{$pengajuan->nama_kegiatan}}" required>
                    </div>
    
                </div>
    
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label class="form-control-label" for="validationCustom01">Estimasi Peserta<small style="color:red">*</small></label>
                        <div class="input-group">
                            <input type="number" class="form-control" min='0' required id="validationDefaultUsername" placeholder="Angka" aria-describedby="inputGroupPrepend1" name="estimasi_peserta" value="{{$pengajuan->estimasi_peserta}}">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend1">Orang</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-control-label" for="validationCustom01">Waktu Mulai Kegiatan<small style="color:red">*</small></label>
                        <input type="date" name="waktu_mulai_kegiatan" class="form-control" id="validationCustom01" value="{{$pengajuan->waktu_mulai_kegiatan}}" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-control-label" for="validationCustom01">Waktu Selesai Kegiatan<small style="color:red">*</small></label>
                        <input type="date" name="waktu_selesai_kegiatan" class="form-control" id="validationCustom01" value="{{$pengajuan->waktu_selesai_kegiatan}}" >
                    </div>
                </div>
                <hr>
                <div class="form-row">
    
                    <div class="col-md-6 mb-3">
                        <label class="form-control-label" for="exampleFormControlSelect1">Pilih Unit Pengguna<small style="color:red">*</small></label>
                        <select class="js-example-basic-single form-control"  name="unit_pengguna" >
                            <option disabled selected>Data Unit . . .</option>
                            @foreach($data_unit_pengguna as $unit_pengguna)
                                <option value="{{$unit_pengguna->nama_ref_unit_lengkap ?? $unit_pengguna->nama_ref_unit_kerja}}" {{ $unit_pengguna->nama_ref_unit_lengkap ?? $unit_pengguna->nama_ref_unit_kerja == $pengajuan->unit_pengguna ? 'selected' : '' }}>{{ $unit_pengguna->nama_ref_unit_lengkap ?? $unit_pengguna->nama_ref_unit_kerja }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="col-md-6 mb-3">
                        <label class="form-control-label" for="validationCustom01">Penanggung Jawab Ruangan<small style="color:red">*</small></label>
                        <input type="text" name="penanggung_jawab_ruangan" class="form-control" placeholder="Masukkan Nama" id="validationCustom01" value="{{$pengajuan->penanggung_jawab_ruangan}}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-control-label" for="validationCustom01">Penanggung Jawab Pengguna<small style="color:red">*</small></label>
                        <input type="text" name="penanggung_jawab_pengguna" class="form-control" placeholder="Masukkan Nama" id="validationCustom01" value="{{$pengajuan->penanggung_jawab_pengguna}}" required>
                    </div>
                </div>
    
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label class="form-control-label" for="exampleFormControlTextarea1">Keterangan (Optional)</label>
                        <textarea name="keterangan" class="form-control" id="exampleFormControlTextarea1" rows="3" value="{{$pengajuan->keterangan}}"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <input type="file" name="dokumen_peminjaman" class="custom-file-input" id="customFileLang" lang="en">
                        <label class="custom-file-label">Pilih Surat (Optional)</label>
                        <small id="fileHelpId" class="form-text text-muted"><a
                            href="{{ asset('dokumen/peminjaman/' . $pengajuan->dokumen_peminjaman) }}"><i class="fa fa-paperclip"
                                aria-hidden="true"></i> File Surat</a></small>
                    </div>
                </div>
            </div>
        </div>   
    </div>
    <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
    </form>
</div>
