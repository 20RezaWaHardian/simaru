<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Data Gedung</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form id="formAction" action="{{ $gedung->id ? route('gedung.update', $gedung->id) : route('gedung.store') }}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="gedungName">Nama Gedung</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="gedungName" value="{{$gedung->nama_gedung}}" name="nama_gedung" placeholder="Ex. Gedung Fasultas Sains dan Teknologi">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="kodeGedung">Kode Gedung</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="kodeGedung" value="{{$gedung->kode_gedung}}" name="kode_gedung" placeholder="Ex. A">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="lokasiGedung">Lokasi Gedung </label>
                    <select class="form-control" name="lokasi_id">
                        <option disabled selected>Pilih Lokasi . . .</option>
                          @foreach($data_lokasi as $lokasi)
                            <option {{$lokasi->id == $gedung->lokasi_id ? 'selected' : ''}} value="{{$lokasi->id}}">{{$lokasi->nama_lokasi}}</option>
                          @endforeach

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
