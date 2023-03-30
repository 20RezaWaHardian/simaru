<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Data Ruangan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form id="formAction" action="{{ $ruangan->id ? route('ruangan.update', $ruangan->id) : route('ruangan.store') }}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="gedungruangan">Nama Gedung </label>
                    <select class="form-control" name="gedung_id">
                        <option disabled selected>Pilih gedung . . .</option>
                          @foreach($data_gedung as $gedung)
                            <option {{$gedung->id == $ruangan->gedung_id ? 'selected' : ''}} value="{{$gedung->id}}">{{$gedung->nama_gedung}} ({{$gedung->kode_gedung}})</option>
                          @endforeach

                      </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="jenisRuangan">Jenis Ruangan </label>
                    <select class="form-control" name="jenis_ruangan_id">
                        <option disabled selected>Pilih Jenis Ruangan . . .</option>
                          @foreach($data_jenis_ruangan as $jenis_ruangan)
                            <option {{$jenis_ruangan->id == $ruangan->jenis_ruangan_id ? 'selected' : ''}} value="{{$jenis_ruangan->id}}">{{$jenis_ruangan->nama_jenis}}</option>
                          @endforeach
                      </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="ruanganName">Nama Ruangan</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="ruanganName" value="{{$ruangan->nama_ruangan}}" name="nama_ruangan" placeholder="Ex. ruangan Fasultas Sains dan Teknologi">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="koderuangan">Kode Ruangan</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="koderuangan" value="{{$ruangan->kode_ruangan}}" name="kode_ruangan" placeholder="Ex. A">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="kapasitas">Kapasitas</label>
                    <input type="number" class="form-control mb-2 mr-sm-2" value="{{$ruangan->kapasitas}}" name="kapasitas">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" name="status" id="exampleFormControlSelect1">
                        <option disabled selected>Pilih Status  . . .</option>
                        <option value="1"  {{ $ruangan->status == "1" ? 'selected' : '' }}>Tersedia</option>
                        <option value="0"  {{ $ruangan->status == "0" ? 'selected' : '' }}>Tidak Tersedia</option>
                    </select>
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
