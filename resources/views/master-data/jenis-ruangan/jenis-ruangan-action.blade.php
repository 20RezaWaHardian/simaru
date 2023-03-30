<div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Data Jenis Ruangan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="formAction" action="{{ $jenis_ruangan->id ? route('jenisR.update', $jenis_ruangan->id) : route('jenisR.store') }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="jenisName">Nama Jenis</label>
                        <input type="text" class="form-control mb-2 mr-sm-2" id="jenisName" value="{{$jenis_ruangan->nama_jenis}}" name="nama_jenis" placeholder="Ex. Aula">
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
