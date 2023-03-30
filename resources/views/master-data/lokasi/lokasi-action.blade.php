<div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Data Lokasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="formAction" action="{{ $lokasi->id ? route('lokasi.update', $lokasi->id) : route('lokasi.store') }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="lokasiName">Nama Lokasi</label>
                        <input type="text" class="form-control mb-2 mr-sm-2" id="lokasiName" value="{{$lokasi->nama_lokasi}}" name="nama_lokasi" placeholder="Ex. Mendalo">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="alamatLokasi">Alamat Lokasi</label>
                        <input type="text" class="form-control mb-2 mr-sm-2" id="alamatLokasi" value="{{$lokasi->alamat_lokasi}}" name="alamat_lokasi" placeholder="Ex. Jl. Raya Jambi - Ma Bulian KM 15">
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
